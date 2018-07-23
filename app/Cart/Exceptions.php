<?php namespace ShoppingCart\Exceptions;

/**
 * Part of the Cart package.
 * NOTICE OF LICENSE
 * Licensed under the Extensions PSL License.
 * This source file is subject to the Extensions PSL License that is
 * bundled with this package in the license.txt file.
 * @package        Cart
 * @version        1.0.2
 * @author         Extensions LLC
 * @license        Extensions PSL
 * @copyright  (c) 2011-2014, Extensions LLC
 * @link           http://Extensions.com
 */
use App\Exceptions\CartException;
use Exception;

// To-Do: Define more classes in separate file to handle exceptions
// In this file, define only generic class which can use for handle generic exceptions for shopping cart
// More classes on separate file can be CartInvalidPriceException, CartInvalidQuantityException,
// CartInvalidQuantityException, CartMissingRequiredIndexException

class CartItemNotFoundException extends CartException
{
    public function __construct()
    {
        $message = $this->getExceptionMessage();
        parent::__construct($message);

    }

    public function getExceptionMessage()
    {
        return trans('product.something_wrong');
    }
}
