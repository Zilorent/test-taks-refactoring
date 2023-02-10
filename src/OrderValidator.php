<?php

namespace Orders;


class OrderValidator
{
	private int $minimumAmount;

	public function setMinimumAmount(int $amount): void
	{
		$this->minimumAmount = $amount;
	}

    public function getMinimumAmount(): int
    {
        return $this->minimumAmount;
    }

    public static function create(): self
    {
    	$validator = new self();
	    $validator->setMinimumAmount(file_get_contents('input/minimumAmount'));
    	return $validator;
    }

	/**
	 * @param $order Order
	 */
    public function validate(Order $order): void
    {
	    $is_valid = true;
	    if (!is_string($order->getName()) || !(strlen($order->getName()) > 2) || !($order->getTotalAmount() > 0) || $order->getTotalAmount() < $this->getMinimumAmount()) {
		    $is_valid = false;
	    }

	    foreach ($order->getItems() as $item_id) {
		    if (!is_int($item_id)) {
			    $is_valid = false;
		    }
	    }

        $order->setIsValid($is_valid);
    }
}
