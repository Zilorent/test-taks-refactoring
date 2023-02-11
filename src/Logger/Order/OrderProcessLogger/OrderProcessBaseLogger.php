<?php

declare(strict_types=1);

namespace Orders\Logger\Order\OrderProcessLogger;

use Orders\Logger\Order\BaseOrderLoggerInterface;
use Orders\Storage\StorageInterface;

abstract class OrderProcessBaseLogger implements BaseOrderLoggerInterface
{
    protected array $logs = [];

    public function __construct(
        protected StorageInterface $storage
    )
    {}

    public function log(string $item): void
    {
        $this->logs[] = $item;
    }
}
