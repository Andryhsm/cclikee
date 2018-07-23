<?php
namespace ShoppingCart;

use App\ProductAttributeValue;
use App\Models\ProductStockAttributeOption;

class CartItemAttribute
{
    protected $id;
    protected $label;
    protected $product_attribute_option_id;
    protected $name;
    protected $value;
    protected $price;
    protected $sku;
    protected $attribute_option_id;
    protected $attribute_id;
    protected $attribute_type;

    /**
     * @return mixed
     */
    public function getAttributeOptionId()
    {
        return $this->attribute_option_id;
    }

    /**
     * @param mixed $attribute_option_id
     */
    public function setAttributeOptionId($attribute_option_id)
    {
        $this->attribute_option_id = $attribute_option_id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
       // dd($this);
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getProductAttributeOptionId()
    {
        return $this->product_attribute_option_id;
    }

    /**
     * @param mixed $product_attribute_option_id
     */
    public function setProductAttributeOptionId($product_attribute_option_id)
    {
        $this->product_attribute_option_id = $product_attribute_option_id;
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param mixed $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function generateRowId()
    {
        return $this->id.'-'.$this->product_attribute_option_id;
    }

    /**
     * @param integer $attribute_id
     */
    public function setAttributeId($attribute_id)
    {
        $this->attribute_id = $attribute_id;
    }

    /**
     * @return int $attribute_id
     */
    public function getAttributeId()
    {
        return $this->attribute_id;
    }

    /**
     * set attribute type
     */
    public function setAttributeType($attribute_type)
    {
        $this->attribute_type = $attribute_type;
    }

    /**
     * @return  $attribute_type
     */
    public function getAttributeType()
    {
        return $this->attribute_type;
    }
    public static function make(ProductStockAttributeOption $product_attr)
    {
        $cart_item_attribute = new CartItemAttribute();
        $cart_item_attribute->setId($product_attr->stock->product_id."_".$product_attr->attribute_id);
        $cart_item_attribute->setProductAttributeOptionId($product_attr->product_stock_attribute_option_id);
        $cart_item_attribute->setLabel($product_attr->attribute->french->attribute_name);
        $cart_item_attribute->setAttributeOptionId($product_attr->attribute_option_id);
        $cart_item_attribute->setName($product_attr->option->french->option_name);
        $cart_item_attribute->setValue($product_attr->option->option_value);
        $cart_item_attribute->setAttributeId($product_attr->attribute_id);
        return $cart_item_attribute;
    }

}
