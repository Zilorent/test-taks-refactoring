<?php

declare(strict_types=1);

namespace Orders\Items;

class KeyboardItem extends ItemBase
{
    protected string $name = 'Keyboard';

    public function isDeliveryCostLarge(): bool
    {
        return false;
    }
}
