<?php

declare(strict_types=1);

namespace Orders\Storage;

interface StorageInterface
{
    public function addToStorage(string $storageName, string $data): void;

    public function readFromStorage(string $storageName): string|bool;
}
