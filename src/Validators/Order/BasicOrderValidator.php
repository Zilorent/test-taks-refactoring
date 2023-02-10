<?php

declare(strict_types=1);

namespace Orders\Validators\Order;

use Orders\Order;

class BasicOrderValidator implements  OrderValidatorInterface
{
    private int $minimumAmount;

    public function __construct()
    {
        $this->setMinimumAmount((int)file_get_contents('input/minimumAmount'));
    }

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

    private function setMinimumAmount(int $amount): void
    {
        $this->minimumAmount = $amount;
    }

    private function getMinimumAmount(): int
    {
        return $this->minimumAmount;
    }
}
