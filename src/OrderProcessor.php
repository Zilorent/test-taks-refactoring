<?php

declare(strict_types=1);

namespace Orders;

use Orders\Items\ItemBase;
use Orders\Logger\Order\OrderProcessLogger\OrderProcessBaseLogger;
use Orders\Logger\Order\OrderResultLogger\OrderResultBaseLogger;
use Orders\Validators\Order\OrderBaseValidator;

class OrderProcessor
{
    private bool $isOrderValid = false;

	public function __construct(
        private OrderDeliveryDetails $orderDeliveryDetails,
        private OrderProcessBaseLogger $orderProcessLogger,
        private OrderResultBaseLogger $orderResultLogger,
        private OrderBaseValidator $orderValidator
    )
	{}

	public function process(Order $order): self
	{
        $this->orderProcessLogger->log("Processing started, OrderId: {$order->getOrderId()}");

		if (!$this->isOrderValid = $this->orderValidator->validateOrder($order)) {
            $this->orderProcessLogger->log("Order is invalid");
            return $this;
        }

        $this->orderProcessLogger->log("Order is valid");

        $this->addDeliveryCostLargeItem($order);

        $this->orderProcessLogger->log("Order \"{$order->getOrderId()}\"" . ($order->getIsManual() ? 'NEEDS MANUAL PROCESSING' : 'WILL BE PROCESSED AUTOMATICALLY'));

        $order->setDeliveryDetails(
            $this->orderDeliveryDetails->getDeliveryDetails(
                count($order->getItems())
            )
        );

        return $this;
	}

    public function saveLogs(): self
    {
        $this->orderResultLogger
            ->saveOrderLog($this->isOrderValid);

        $this->orderProcessLogger
            ->saveOrderLog($this->isOrderValid);

        return $this;
    }

	private function addDeliveryCostLargeItem(Order $order): void
	{
        /** @var ItemBase $item */
        foreach ($order->getItems() as $item) {
			if ($item->isDeliveryCostLarge()) {
				$order->setTotalAmount($order->getTotalAmount() + 100);
			}
		}
	}
}
