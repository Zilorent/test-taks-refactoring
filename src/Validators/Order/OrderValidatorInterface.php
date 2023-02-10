<?php

declare(strict_types=1);

namespace Orders\Validators\Order;

use Orders\Order;

interface OrderValidatorInterface
{
    public function validateOrder(Order $order): bool;
}
