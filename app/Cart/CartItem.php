<?php
namespace ShoppingCart;

use App\Product;
use App\ProductAttributeValue;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use ShoppingCart\Exceptions\CartInvalidAttributesException;
use App;
use App\Exceptions\CartException;

class CartItem implements Arrayable
{
    use App\Libraries\Appendable;

    protected $id;
    protected $name;
    protected $sku;
    protected $quantity = 1;
    protected $price;
    protected $discounts = [];
    //protected $promotion_name = '';
    protected $image;
    protected $alt;
    /** @var  Collection | CartItemAttribute[] */
    protected $attributes;
    /** @var  CartItem[] */
    protected $url;
    protected $category_ids;
    protected $categories_name;
    protected $wishlist_id;
    protected $status_id;
    protected $parent_row_id = null;
    protected $error_flag;
    protected $categories;
    protected $item_type;
// 	protected $radius;
// 	protected $postal_code;
	protected $brand;
	protected $original_price;

    const PRODUCT_QUANTITY_NOT_AVAILABLE = "Item quantity is updated in the bag as per stock availability at this moment.";
    const REMOVED_ITEM_FROM_CART = "Item is removed from the bag due to stock unavailability at this moment.";
    const MANAGE_STOCK = '1';
    const INVENTORY_UNAVAILABLE_FLAG = 1;
    const NOT_ENOUGH_INVENTORY_FLAG = 2;
    const PERSONALIZATION_UPDATED_FLAG = 4;
    public static $error_message = [
        1=>"Item is removed from the bag due to stock unavailability at this moment.",
        2=>"Item quantity is updated in the bag as per stock availability at this moment.",
        4=>"We have updated this product.Click the edit link to review product to ensure it has not been affected by our update.",
        6=>"Item quantity is updated in the bag as per stock availability at this moment.We have updated this product.Click the edit link to review product to ensure it has not been affected by our update.",
    ];

    public function __construct()
    {
        $this->attributes = new Collection();
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }


    /**
     * @return Collection|CartItemAttribute[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }


    public function getCategoryIds()
    {
        return $this->category_ids;
    }

    public function getCategoriesName()
    {
        return $this->categories_name;
    }

    public function init(Product $product, $data)
    {
        $this->id                      = $product->product_id;
        $this->quantity                = $data['qty'];
        $this->parent_row_id = isset($data['parent_row_id']) ? $data['parent_row_id'] : null;
		$this->brand = $product->brand_id;

        $user_attrs = [];
        if (isset($data['attrs']) && is_array($data['attrs'])) {
            $user_attrs = $data['attrs'];
        }
        
        $this->category_ids = [];
        $this->categories_name = [];
        $this->categories=$product->categories;
        
        foreach ($product->categories as $category) {
            $this->category_ids[] = $category->category_id;
            $this->categories_name[] = $category->category_name;
        }
        
        $this->initAttributes($product, $user_attrs);
        $this->refresh($product);
        
    }

    /**
     * @param Product $product
     * @param $user_attrs
     */
    public function initAttributes(Product $product, $user_attrs)
    {   
        foreach($product->stocks as $stock){
            foreach($stock->options as $option){
                if(in_array($option->attribute_option_id,$user_attrs)){
                    $cart_item_attribute = CartItemAttribute::make($option);
    				$list_cart_item_attribute[] = $cart_item_attribute;
                    $this->attributes->put($cart_item_attribute->getId(), $cart_item_attribute); 
                }
            }
        }
        
        /*dd($this->attributes);
        foreach ($product->attributeValues as $product_attr) {
    		if (in_array($product_attr->product_attribute_option_id,$user_attrs)) {
				$cart_item_attribute = CartItemAttribute::make($product_attr);
				$list_cart_item_attribute[] = $cart_item_attribute;
                $this->attributes->put($cart_item_attribute->getId(), $cart_item_attribute);
		    }
        }*/
    }

    public function refresh(Product $product, $init_grouped_items = true)
    {
        $this->url             = $product->url->target_url;
        $this->name            = $product->french->product_name;
        $this->original_price  = $product->original_price;
        $this->sku             = $product->sku;
        $color_id           = 0;
        $this->category_ids = [];
        $this->categories_name = [];
        $this->categories=$product->categories;
        
        foreach ($product->categories as $category) {
            $this->category_ids[] = $category->category_id;
            $this->categories_name[] = $category->french->category_name;
        }
        foreach ($product->attributeValues as $product_attr) {
			/** @var CartItemAttribute $item_attr */
			$cart_item_attribute = $this->attributes->get($product_attr->product_id."_".$product_attr->attribute_id);
			if ($cart_item_attribute != null) {
				$cart_item_attribute->setLabel($product_attr->attribute->french->attribute_name);
			    if(isset($product_attr->option))
                	$cart_item_attribute->setValue($product_attr->option->french->option_value);
			
			}
        }
       
        $image       = $product->images->first();
        $this->image = $image->image_name;
        $this->alt = $image->alt;
        
    }

    public function getProduct()
    {
    	$id = $this->id;
		return \Cache::remember($id, 60, function () use ($id) {
			return Product::whereProductId($id)->first();
		});
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function generateRowId()
    {
        $attribute_key           = '';
        foreach ($this->attributes as $attribute) {
            $attribute_key .= $attribute->generateRowId() . '_';
        }
        $parent_row_id = $this->getParentRowID();
        return md5($this->id . $attribute_key.$parent_row_id);
    }

    public function addQuantity($qty)
    {
        $this->setQuantity($this->getQuantity() + $qty);
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = round($quantity);
    }

    public function getSku()
    {
        $sku = $this->sku;
/*        foreach ($this->attributes as $attr)
        {
            $sku = $sku . "-" . $attr->getSku();
        }*/
        return $sku;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getImageAlt()
    {
        return $this->alt;
    }


    public function serializeAttributes()
    {
        $ret = [];
        foreach ($this->attributes as $attribute) {
            $ret[$attribute->getId()] = $attribute->getProductAttributeOptionId();
        }
        return $ret;
    }


    public function setWishlistId($wishlist_id)
    {
        $this->wishlist_id = $wishlist_id;
    }

    public function getWishlistId()
    {
        return $this->wishlist_id;
    }

    public function clearWishlistId()
    {
        $this->wishlist_id = null;
    }

    public function getTotal()
    {
        $total = $this->getOriginalPrice() * $this->getQuantity();
        return $total;
    }

    public function getOriginalPrice()
	{
		return $this->original_price;
	}

	public function getAllAttributeOptionId()
    {
        $attribute_option_ids = [];
        foreach ($this->attributes as $attribute) {
            $attribute_option_ids[] = $attribute->getAttributeOptionId();
        }
        return $attribute_option_ids;
    }

    public function getAttributeSku()
    {
        $sku ='';
        foreach ($this->attributes as $attr) {
            $sku = $sku . "-" . $attr->getSku();
        }
        return $sku;
    }
    public function getParentRowID()
    {
        return $this->parent_row_id;
    }

    public function setParentRowID($parent_row_id)
    {
        $this->parent_row_id = $parent_row_id;
    }

    public function getErrorFlag()
    {
        return $this->error_flag;
    }
    public function setErrorFlag($error_flag)
    {
        $this->error_flag = $error_flag;
    }
    public  function  getMainCategoryName(){

        foreach ($this->categories as $category) {
            if ($category->parent != null && $category->parent->is_byo == '1') {
                return \Illuminate\Support\Str::slug(str_replace('Build Your Own', '', $category->parent->category_name));
            }
        }
    }

    protected function getAppendKeys()
    {
        return [
            'sku',
            'total',
            'subtotal',
            'base_subtotal',
            'attribute_subtotal',
            'price',
            'proofing_amount',
            'base_price',
            'base_attribute_price',
            'personalization_price',
            'discount_amount',
            'discount_percentage',
            'tax',
            'attribute_sku',
            'generate_row_id'
        ];
    }

    public function toArray()
    {
        $ret = [];
        foreach ($this->getSerializableKeys() as $key) {
            $ret[$key] = $this->$key;
        }
        $ret = $ret + $this->getAppendable();
        return $ret;
    }

    protected function getSerializableKeys()
    {
        return array_keys(array_diff_key(get_object_vars($this), array_flip($this->getNonSerializableKeys())));
    }

    protected function getNonSerializableKeys()
    {
        return [
            "storage",
            "dispatcher",
            "fireEvents",
            "categories"
        ];
    }

    public function resetAttributes()
    {
        $this->attributes = [];
    }

//     public function getRadius()
// 	{
// 		return $this->radius;
// 	}
	public function getPostalCode()
	{
		return $this->postal_code;
	}
	public function getBrand()
	{
		return $this->brand;
	}
}
