<?php

declare(strict_types=1);

namespace Orders\Logger\Order\OrderProcessLogger;

class OrderProcessFileLogger extends OrderProcessBaseLogger
{
    public function saveOrderLog(bool $isOrderValid): void
    {
        $lineWithoutDebugInfo = [];

        if ($isOrderValid) {
            foreach ($this->logs as $line) {
                if (!str_contains($line, 'Reason:')) {
                    $lineWithoutDebugInfo[] = $line;
                }
            }
        }

        file_put_contents('orderProcessLog', @file_get_contents('orderProcessLog') . implode("\n", $lineWithoutDebugInfo ?? $this->logs ));
    }
}
