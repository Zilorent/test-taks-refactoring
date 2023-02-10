<?php
declare(strict_types=1);

namespace Orders\Logger\Order\OrderProcessLogger;

use Orders\Logger\Order\BaseOrderLoggerInterface;

abstract class OrderProcessBaseLogger implements BaseOrderLoggerInterface
{
    protected array $logs = [];

    public function log(string $item): void
    {
        $this->logs[] = $item;
    }
}
