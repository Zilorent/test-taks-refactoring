<?php

declare(strict_types=1);

namespace Orders\Validators\Order;

use Orders\Order;

class OrderBasicValidator extends  OrderBaseValidator
{
    public function validateOrder(Order $order): bool
    {
        if (
            !is_string($order->getName()) ||
            !(strlen($order->getName()) > 2) ||
            !($order->getTotalAmount() > 0) ||
            $order->getTotalAmount() < $this->getMinimumAmount()
        ) {
            return false;
        }

        foreach ($order->getItems() as $item_id) {
            if (!is_int($item_id)) {
                return false;
            }
        }

        return true;
    }

    private function getMinimumAmount(): int
    {
        return (int)$this->storage->readFromStorage('input/minimumAmount');
    }
}