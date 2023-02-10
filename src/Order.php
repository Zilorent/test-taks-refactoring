<?php

declare(strict_types=1);

namespace Orders;


class Order
{
	private int $orderId;
    private bool $isManual = false;
    private string $name;
    private array $items;
    private float $totalAmount;
    private string $deliveryDetails;
    private bool $isValid;

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

    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
    }

    public function getIsValid(): bool
    {
        return $this->isValid;
    }

    public function setIsManual(bool $isManual): self
    {
        $this->isManual = $isManual;

        return $this;
    }

    public function getIsManual(): bool
    {
        return $this->isManual;
    }
}
