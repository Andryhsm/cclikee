<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
		'admin/product/upload',
		'admin/remove-product-image',
		'admin/product/attributes',
		'admin/get-tag',
		'admin/save-tag',
		'admin/get-coordinates',
		'admin/assign-brand-tag-category',
		'admin/category/update-order',
		'admin/get-blog-tag',
		"admin/get-post",
    ];
}
