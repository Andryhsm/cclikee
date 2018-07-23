<?php
/**
 * Created by PhpStorm.
 * User: chirag-prajapati
 * Date: 28/6/17
 * Time: 5:54 PM
 */

namespace App\Libraries;


use GuzzleHttp\Client;

class CommissionJunction
{

    const AUTHORIZATION_KEY = "00be644e6e12d5803026e49f5c3370cf4738569afaf3a87fff0dd19d6702c597eb9d84e996edc472c6130bfa08619633f85eb5fcf231d824f275ad9f1f0093539f/191529e8027f322625d994cd16d1d3dcf42524c1cefbf1f0ee27216f82c3f9618cdb0ca0e7c4c998057a91d1d8fd5be5235e2e845d578698af7211c43b679d11";
    protected $client;

    public function __construct()
    {
        $this->client = new Client();

    }

    public function get($keyword)
    {
        $products = [];
        try {
            $res = $this->client->request('GET', 'https://product-search.api.cj.com/v2/product-search?website-id=8224756&keywords=' . $keyword, [
                'headers' => ['Authorization' => self::AUTHORIZATION_KEY]
            ]);
            $returnXML = simplexml_load_string($res->getBody());
            $products = json_decode(json_encode($returnXML), 1);
        } catch (\Exception $e) {
            //$returnXML = [];
        }
        return $products;
    }
}