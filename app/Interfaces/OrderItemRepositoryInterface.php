<?php

namespace App\Interfaces;


interface OrderItemRepositoryInterface
{
	public function saveItem($cart_item, $order);

	public function ByStatus($status_id,$brands);

	public function updateStatus($status_id,$order_item_id);

	public function getItemByStatus($status_id);

	public function getPendingItemsByMerchant($user_id);

	public function getWaitingItemsByMerchant($brands,$user_id);

	public function getEarnedItemsByMerchant($user_id);

	public function itemByStatusAndUser($status_id,$user_id);

	public function getChoosenItemByUser($user_id);

	public function getBookedItemByUser($user_id);

	public function getAllInvoiceItems();

	public function getAllBookedItems();

	public function getBookedItemById($id);
	
}