<?php

declare(strict_types=1);

use Orders\Order;
use Orders\OrderDeliveryDetails;
use Orders\OrderProcessor;
use Orders\Logger\Order\OrderProcessLogger\OrderProcessFileLogger;
use Orders\Logger\Order\OrderResultLogger\OrderResultFileLogger;
use Orders\Validators\Order\OrderBasicValidator;
use Orders\Storage\FileStorage;
use Orders\Items\KeyboardItem;

require_once 'vendor/autoload.php';

$order = new Order();
$order
    ->setOrderId(2)
    ->setName('John')
    ->setItems([
        new KeyboardItem(),
    ])
    ->setTotalAmount(346.2);

$storage = new FileStorage();

$orderProcessor = new OrderProcessor(
    new OrderDeliveryDetails(),
    new OrderProcessFileLogger(
        $storage
    ),
    new OrderResultFileLogger(
        $storage,
        $order
    ),
    new OrderBasicValidator(
        $storage
    )
);
$orderProcessor
    ->process($order)
    ->saveLogs();
