<?php

namespace App\Interfaces;


interface OrderRepositoryInterface
{
    public function saveOrder($cart);

    public function completedOrders($customer_id);

    public function onGoingOrders($customer_id);

    public function byId($order_id);

	public function updateStatusById($order_id,$order_status_id);

	public function getCount();

	public function getDashboardOrders();

	public function getByStatus($status);
}