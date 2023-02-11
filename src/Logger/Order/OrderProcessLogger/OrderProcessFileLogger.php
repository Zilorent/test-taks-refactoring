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

        $this->storage->addToStorage('orderProcessLog', implode("\n", $lineWithoutDebugInfo ?? $this->logs ));
    }
}
