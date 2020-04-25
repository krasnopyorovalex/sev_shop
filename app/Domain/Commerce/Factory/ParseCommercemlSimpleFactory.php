<?php

declare(strict_types=1);

namespace Domain\Commerce\Factory;

use Domain\Commerce\Parsers\ImportCommercemlParser;
use Domain\Commerce\Parsers\OfferCommercemlParser;
use InvalidArgumentException;

final class ParseCommercemlSimpleFactory
{
    /**
     * @param string $filename
     */
    public static function factory(string $filename): void
    {
        if (strpos('import', $filename) !== false) {
            new ImportCommercemlParser($filename);
        }

        if (strpos('offer', $filename) !== false) {
            new OfferCommercemlParser($filename);
        }

        throw new InvalidArgumentException('Unknown filename for parsing given');
    }
}
