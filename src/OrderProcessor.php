<?php

declare(strict_types=1);

namespace Orders;

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

        if ($order->getIsManual()) {
            $this->orderProcessLogger->log("Order \"{$order->getOrderId()}\" NEEDS MANUAL PROCESSING");
        } else {
            $this->orderProcessLogger->log("Order \"{$order->getOrderId()}\" WILL BE PROCESSED AUTOMATICALLY");
        }

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
		foreach ($order->getItems() as $item) {
			if (in_array($item, [3231, 9823])) {
				$order->setTotalAmount($order->getTotalAmount() + 100);
			}
		}
	}
}
