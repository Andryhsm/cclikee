<?php
namespace ShoppingCart;

use App;
use App\Interfaces\ProductRepositoryInterface;
use App\Product;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;
use Omnipay;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Collection;
use ShoppingCart\Storage\LocalStore;
use ShoppingCart\Exceptions\CartItemNotFoundException;
use App\Exceptions\CartException;
use Exception;
use App\StoreConfig;
use Cache;
use Hash;
use Session;

class Cart implements Arrayable
{
    use App\Libraries\Appendable;
    /**
     * Holds the Cart identifier.
     * @var mixed
     */
    protected $id;
    /**
     * The storage driver used by Cart.
     * @var \ShoppingCart\Storage\StorageInterface
     */
    protected $storage;
    /**
     * The event dispatcher instance.
     * @var \Illuminate\Events\Dispatcher
     */
    protected $dispatcher;
    /**
     * Flag for whether we should fire events or not.
     * @var bool
     */
    protected $fireEvents = true;
    /** @var  Collection | CartItem[] */
    protected $items;

    protected $metaData = [];

    protected $billing_address;
    /** @var  App\Models\Customer */
    protected $customer = null;
    protected $error_flag;
	protected $payment_type;
    public $error_message = [
        1=>"Item is removed from the bag due to stock unavailability at this moment.",
        4=>"We have updated one or more items that are currently in your cart. Please review the cart to proceed with your order."
    ];
    const PERSONALIZATION_UPDATED_FLAG = 4;
    const AUSTIN_ZIP_CODE = 78753;
    const TEXAS_STATE_ID=57;
    const TAX_CLASS = '5';
    const PRODUCT_UNAVAILABLE = 'Item is not available at this moment.';

    public function __construct($id, $storage, $dispatcher)
    {
        $this->id = $id;
        $this->storage = $storage;
        $this->dispatcher = $dispatcher;
        $this->items = new Collection();
        $this->cart_validator=new CartValidator();
        if ($this->storage == "") {
            $this->storage = new LocalStore();
        }
        if ($this->dispatcher == "") {
            $this->dispatcher = new Dispatcher();
        }
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        $this->save();
    }


    /**
     * @return CustomerAddress
     */
    public function getBillingAddress()
    {
        return $this->billing_address;
    }

    /**
     * @param CustomerAddress $billing_address
     */
    public function setBillingAddress($billing_address)
    {
        $this->billing_address = $billing_address;
        $this->save();
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getAllId()
    {
        $product_ids = [];
        foreach ($this->items as $item) {
            $product_ids[] = $item->getId();
        }
        return $product_ids;
    }

    public function update($row_id, CartItem $item)
    {
        // Check if the item exists
        if (!$this->exists($row_id)) {
            throw new CartItemNotFoundException;
        }
        // Update the item
        //Remove old row_id and add $item with new rowId
        $this->items->forget($row_id);
        $new_row_id = $item->generateRowId();
        $this->items->put($new_row_id, $item);
        $this->save();
        // Fire the 'Extensions.cart.updated' event
        $this->fire('updated', [$this->item($new_row_id),
            $this]);
    }

    /**
     * Check if the item exists in the cart.
     * @param  string $rowId
     * @return bool
     */
    public function exists($rowId)
    {
        return $this->items->has($rowId);
    }

    public function save()
    {
        $this->storage->put($this->serialize());
    }

    public function serialize()
    {
        $ret = [];
        foreach ($this->getSerializableKeys() as $key) {
            $ret[$key] = $this->$key;
        }
        return $ret;
    }

    protected function getSerializableKeys()
    {
        return array_keys(array_diff_key(get_object_vars($this), array_flip($this->getNonSerializableKeys())));
    }

    protected function getNonSerializableKeys()
    {
        return ["id",
            "storage",
            "dispatcher",
            "fireEvents"];
    }

    protected function getAppendKeys()
    {
        return [
            'total',
            'total_before_shipping',
            'subtotal',
            'discount',
        ];
    }

    public function toArray()
    {
        $cart_array = $this->serialize();
        $cart_array = $cart_array + $this->getAppendable();
        $cart_array['items'] = array_values($this->items->toArray());
        return $cart_array;
    }

    /**
     * Fires an event.
     * @param  string $event
     * @param  mixed $data
     * @return void
     */
    protected function fire($event, $data)
    {
        // Check if we should fire events
        if ($this->fireEvents) {
            $this->dispatcher->fire("cart.{$event}", $data);
        }
    }

    /**
     * Returns information about the provided item.
     * @param  string $rowId
     * @return CartItem
     * @throws CartItemNotFoundException
     */
    public function item($rowId)
    {
        // Check if the item exists
        if (!$this->exists($rowId)) {
            throw new CartItemNotFoundException;
        }
        // Return the item
        return $this->items->get($rowId);
    }

    public function remove($row_id)
    {
        $item = $this->removeSilently($row_id);
        // Fire the 'Extensions.cart.removed' event
        $this->fire('removed', [$item,
            $this]);
    }

    public function removeSilently($row_id)
    {
        // Check if the item exists
        if (!$this->exists($row_id)) {
            throw new CartItemNotFoundException;
        }
        $item = $this->item($row_id);
        // Remove the item
        $this->items->forget($row_id);
        $this->save();
        return $item;
    }

    /**
     * Search for items with the given criteria.
     * @param  CartItem|array $data
     * @return CartItem
     */
    public function find($data)
    {
        $rows = [];
        foreach ($this->items as $item) {
            /** @var CartItem $item */
            if ($item->equals($data)) {
                $rows[] = $item;
            }
        }
        return $rows;
    }

    public function refresh(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->setErrorFlag(0);
        $product_ids = [];
        foreach ($this->items as $item) {
            $product_ids[] = $item->getId();
        }
        if (count($product_ids) == 0) {
            return;
        }
        $products = [];
        //loop is better for caching. Do not change this. Shabbir
        foreach($product_ids as $product_id) {
            $product = $productRepositoryInterface->getProductById($product_id);
            if($product != null) {
                $products[] = $product;
            }
        }
        $products = \Illuminate\Database\Eloquent\Collection::make($products);
        foreach ($this->items as $item) {
            /** @var Product $product */
            $product = $products->find($item->getId());
            $old_fire_events = $this->fireEvents;
            $this->fireEvents = false;
            $this->cart_validator->validate($product,$item);
            if($item->getErrorFlag()==1){
                $item_id = $item->generateRowId();
                $this->remove($item_id);
                $this->setErrorFlag(1);
            }
            if($product != null){
                $item->refresh($product);
            }
            $this->fireEvents = $old_fire_events;
        }
        $this->save();
    }



    /**
     * Empties the cart.
     * @return void
     */
    public function clear()
    {
        $this->items = new Collection();
        $this->metaData = [];
        $this->save();
        // Fire the 'Extensions.cart.cleared' event
        $this->fire('cleared', $this);
    }

    /**
     * Synchronizes a collection of data with the cart.
     * @param  \Illuminate\Support\Collection $items
     * @return void
     */
    public function sync(Collection $items)
    {
        // Turn events off
        $this->fireEvents = false;
        foreach ($items->all() as $item) {
            $this->add($item);
        }
        // Turn events on
        $this->fireEvents = true;
    }

    public function add(CartItem $item)
    {
        $row_id = $this->addSilently($item);
        $this->fire('added', [$this->item($row_id),
            $this]);
    }

    public function addSilently(CartItem $item)
    {
        $row_id = $item->generateRowId();
        if ($this->exists($row_id)) {
            // Get the item
            $row = $this->item($row_id);
            // Update the item quantity
            $row->addQuantity($item->getQuantity());
        } else {
            $this->items->put($row_id, $item);
        }
        $this->save();
        return $row_id;
    }

    public function recent($count = 5)
    {
        if ($this->count() <= $count) {
            return $this->items();
        }
        return $this->items()->slice($this->count() - $count, $this->count(), true);
    }

    public function count()
    {
        return $this->items->count();
    }

    /**
     * @return Collection|CartItem[]
     */
    public function items()
    {
        return $this->items;
    }

    public function total()
    {
		$item_total = 0;
		foreach ($this->items as $item) {
			$item_total += $item->getTotal();
		}
		return $item_total;
    }

    public function totalRebate()
	{
		$item_rebate = 0;
		foreach ($this->items as $item) {
			$item_rebate += $item->getRebate();
		}
		return $item_rebate;
	}

    public function getMetaData($key = null)
    {
        if ($key == null) {
            return $this->metaData;
        }
        return isset($this->metaData[$key]) ? $this->metaData[$key] : null;
    }

    public function setMetaData($key, $value)
    {
        $this->metaData[$key] = $value;
        $this->save();
    }


    public function restore()
    {
        if ($this->storage->has()) {
            $this->unserialize($this->storage->get());
        }
    }

    public function unserialize($data)
    {
        foreach ($this->getSerializableKeys() as $key) {
            if (!empty($data[$key])) {
                $this->$key = $data[$key];
            }
        }
    }

    public function cartQuantity()
    {
        $total_cart_items=0;
        foreach ($this->items() as $item_id => $item) {
            if ($item->getPrice() > 0) {
                $total_cart_items += $item->getQuantity();
            }
        }
        return $total_cart_items;
    }

    public function setErrorFlag($error_flag)
    {
        $this->error_flag = $error_flag;
    }

    public function getErrorFlag()
    {
        $error_flag = $this->error_flag;
        foreach ($this->items() as $row_id => $item) {
            if ($item->getErrorFlag() == 4 || $item->getErrorFlag()==6) {
                $error_flag = self::PERSONALIZATION_UPDATED_FLAG;
            }
        }
        return $error_flag;
    }

    public function setPaymentType($type)
	{
		$this->payment_type = $type;
		$this->save();
	}
	public function getPaymentType()
	{
		return $this->payment_type;
	}
}
