<?php

declare(strict_types=1);

namespace Orders\Items;

class ShippingContainerItem extends ItemBase
{
    protected string $name = 'ShippingContainer';

    public function isDeliveryCostLarge(): bool
    {
        return true;
    }
}
