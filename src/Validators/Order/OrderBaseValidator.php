<?php

declare(strict_types=1);

namespace Orders\Validators\Order;

use Orders\Order;
use Orders\Storage\StorageInterface;

abstract class OrderBaseValidator
{
    public function __construct(
        protected StorageInterface $storage
    )
    {}

    public abstract function validateOrder(Order $order): bool;
}
