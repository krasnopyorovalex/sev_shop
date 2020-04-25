<?php

declare(strict_types=1);

namespace Domain\Commerce\Parsers;

class OfferCommercemlParser extends CommercemlParser
{
    public function parse(): void
    {
        \Log::info("Filename: {$this->filename}");
    }
}
