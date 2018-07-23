<?php
/**
 * Created by PhpStorm.
 * User: chirag-prajapati
 * Date: 28/6/17
 * Time: 5:57 PM
 */

namespace App\Libraries;

use Amazon;


class AmazonSearch
{

    public function __construct()
    {
    }

    public function get($keyword)
    {
        try {
            $results = Amazon::search($keyword)->json();
        } catch (\Exception $e) {
            $results = [];
        }
        return $results;
    }
}