<?php

declare(strict_types=1);

namespace Orders;


use Orders\Exceptions\WrongItemTypeException;
use Orders\Items\ItemBase;

class Order
{
	private int $orderId;
    private bool $isManual = false;
    private string $name;
    private array $items;
    private float $totalAmount;
    private string $deliveryDetails;

	public function setName(string $name): self
	{
		$this->name = $name;

        return $this;
	}

    public function getName(): string
    {
        return $this->name;
    }

	public function setItems(array $items): self
	{
        array_map(function($item){
            if (!$item instanceof ItemBase) {
                throw new WrongItemTypeException();
            }
        }, $items);

		$this->items = $items;

        return $this;
	}

    public function getItems(): array
    {
        return $this->items;
    }

	public function setTotalAmount(float $totalAmount): self
	{
		$this->totalAmount = $totalAmount;

        return $this;
	}

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

	public function setOrderId(int $orderId): self
	{
		$this->orderId = $orderId;

        return $this;
	}

    public function getOrderId(): int
    {
        return $this->orderId;
    }

	public function setDeliveryDetails(string $deliveryDetails): self
	{
		$this->deliveryDetails = $deliveryDetails;

        return $this;
	}

    public function getDeliveryDetails(): string
    {
        return $this->deliveryDetails;
    }

    public function getIsManual(): bool
    {
        return $this->isManual;
    }
}
