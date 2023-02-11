<?php

declare(strict_types=1);

namespace Orders\Logger\Order\OrderResultLogger;

use Orders\Logger\Order\BaseOrderLoggerInterface;
use Orders\Order;
use Orders\Storage\StorageInterface;

abstract class OrderResultBaseLogger implements BaseOrderLoggerInterface
{
    public function __construct(
        protected StorageInterface $storage,
        protected Order $order
    )
    {}
}
