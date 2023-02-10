<?php

declare(strict_types=1);

namespace Orders;

class OrderProcessor
{
	private OrderValidator $validator;
	private OrderDeliveryDetails $orderDeliveryDetails;

	public function __construct(OrderDeliveryDetails $orderDeliveryDetails)
	{
		$this->orderDeliveryDetails = $orderDeliveryDetails;
		$this->validator = OrderValidator::create();
	}

	/**
	 * @param $order Order
	 */
	public function process($order)
	{
		ob_start();
		echo "Processing started, OrderId: {$order->getOrderId()}\n";
		$this->validator->validate($order);

		if ($order->getIsValid()) {
			echo "Order is valid\n";
			$this->addDeliveryCostLargeItem($order);
			if ($order->getIsManual()) {
				echo "Order \"" . $order->getOrderId() . "\" NEEDS MANUAL PROCESSING\n";
			} else {
				echo "Order \"" . $order->getOrderId() . "\" WILL BE PROCESSED AUTOMATICALLY\n";
			}
			$deliveryDetails = $this->orderDeliveryDetails->getDeliveryDetails(count($order->getItems()));
			$order->setDeliveryDetails($deliveryDetails);
		} else {
			echo "Order is invalid\n";
		}

		$this->printToFile($order);
	}

	/**
	 * @param $order Order
	 */
	public function addDeliveryCostLargeItem($order)
	{
		foreach ($order->getItems() as $item) {
			if (in_array($item, [3231, 9823])) {
				$order->setTotalAmount($order->getTotalAmount() + 100);
			}
		}
	}

	public function printToFile(Order $order)
	{
		$result = ob_get_contents();
		ob_end_clean();

		if ($order->getIsValid()) {
			$lines = explode("\n", $result);
			$lineWithoutDebugInfo = [];
			foreach ($lines as $line) {
				if (strpos($line, 'Reason:') === false) {
					$lineWithoutDebugInfo[] = $line;
				}
			}
		}

		file_put_contents('orderProcessLog', @file_get_contents('orderProcessLog') . implode("\n", $lineWithoutDebugInfo ?? [$result] ));
		if ($order->getIsValid()) {
			file_put_contents('result', @file_get_contents('result') . $order->getOrderId() . '-' . implode(',', $order->getItems()) . '-' . $order->getDeliveryDetails() . '-' . ($order->getIsManual() ? 1 : 0) . '-' . $order->getTotalAmount() . '-' . $order->getName() . "\n");
		}
	}
}
