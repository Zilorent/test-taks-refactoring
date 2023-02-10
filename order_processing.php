<?php

declare(strict_types=1);

use Orders\Order;
use Orders\OrderDeliveryDetails;
use Orders\OrderProcessor;
use Orders\Logger\Order\OrderProcessLogger\OrderProcessFileLogger;
use Orders\Validators\Order\BasicOrderValidator;
use Orders\Logger\Order\OrderResultLogger\OrderResultFileLogger;

require_once 'vendor/autoload.php';

$order = new Order();
$order
    ->setOrderId(2)
    ->setName('John')
    ->setItems([
        6654,
    ])
    ->setTotalAmount(346.2);

$orderProcessor = new OrderProcessor(
    new OrderDeliveryDetails(),
    new OrderProcessFileLogger(),
    new OrderResultFileLogger($order),
    new BasicOrderValidator()
);
$orderProcessor
    ->process($order)
    ->saveLogs();
