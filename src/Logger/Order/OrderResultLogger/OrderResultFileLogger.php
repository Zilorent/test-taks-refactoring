<?php

declare(strict_types=1);

namespace Orders\Logger\Order\OrderResultLogger;

class OrderResultFileLogger extends OrderResultBaseLogger
{
    public function saveOrderLog(bool $isOrderValid): void
    {
        if (!$isOrderValid) {
            return ;
        }

        $this->storage->addToStorage('result', implode('-',[
            $this->order->getOrderId(),
            implode(',', $this->order->getItems()),
            $this->order->getDeliveryDetails(),
            ($this->order->getIsManual() ? 1 : 0),
            $this->order->getTotalAmount(),
            $this->order->getName(),
        ]));
    }
}
