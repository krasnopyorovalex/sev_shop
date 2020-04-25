<?php

declare(strict_types=1);

namespace Domain\Commerce\Parsers;

class ImportCommercemlParser extends CommercemlParser
{
    public function parse(): void
    {
        \Log::info("Filename: {$this->filename}");
    }
}
