<?php

declare(strict_types=1);

use Orders\Order;
use Orders\OrderDeliveryDetails;
use Orders\OrderProcessor;

require_once 'vendor/autoload.php';

$order = new Order();
$order
    ->setOrderId(2)
    ->setName('John')
    ->setItems([
        6654,
    ])
    ->setTotalAmount(346.2);

$orderProcessor = new OrderProcessor(new OrderDeliveryDetails());
$orderProcessor->process($order);
