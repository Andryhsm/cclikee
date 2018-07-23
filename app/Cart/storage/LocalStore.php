<?php
/**
 * Created by PhpStorm.
 * User: shabbir
 * Date: 9/24/14
 * Time: 7:49 PM
 */
namespace ShoppingCart\Storage;

class LocalStore implements StorageInterface
{

    protected $storage;

    /**
     * Returns the session key.
     * @return string
     */
    public function getKey()
    {
        return 0;
    }

    /**
     * Return the session instance.
     * @return string
     */
    public function identify()
    {
        return 0;
    }

    /**
     * Get the value from the storage.
     * @return mixed
     */
    public function get()
    {
        return $this->storage;
    }

    /**
     * Put a value.
     * @param  mixed $value
     * @return void
     */
    public function put($value)
    {
        $this->storage = $value;
    }

    /**
     * Checks if an attribute is defined.
     * @return bool
     */
    public function has()
    {
        return isset($this->storage);
    }

    /**
     * Remove the storage.
     * @return void
     */
    public function forget()
    {
        unset($this->storage);
    }
}
