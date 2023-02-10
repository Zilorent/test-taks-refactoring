<?php

declare(strict_types=1);

namespace Orders\Logger\Order;

interface BaseOrderLoggerInterface
{
    public function saveOrderLog(bool $isOrderValid): void;
}
