<?php

declare(strict_types=1);

namespace Orders\Storage;

class FileStorage implements StorageInterface
{
    public function addToStorage(string $storageName, string $data): void
    {
        file_put_contents($storageName, $data . "\r\n", FILE_APPEND);
    }

    public function readFromStorage(string $storageName): string|bool
    {
        return file_get_contents($storageName);
    }
}
