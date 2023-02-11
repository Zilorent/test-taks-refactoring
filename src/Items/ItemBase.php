<?php

declare(strict_types=1);

namespace Orders\Items;

abstract class ItemBase
{
    protected string $name;

    public abstract function isDeliveryCostLarge(): bool;

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
