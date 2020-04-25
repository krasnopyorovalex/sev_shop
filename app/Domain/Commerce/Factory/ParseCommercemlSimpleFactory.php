<?php

declare(strict_types=1);

namespace Domain\Commerce\Factory;

use Domain\Commerce\Parsers\CommercemlParser;
use Domain\Commerce\Parsers\ImportCommercemlParser;
use Domain\Commerce\Parsers\OfferCommercemlParser;
use InvalidArgumentException;

final class ParseCommercemlSimpleFactory
{
    /**
     * @param string $filename
     * @return CommercemlParser
     */
    public static function factory(string $filename): CommercemlParser
    {
        if (strpos('import', $filename) !== false) {
            return new ImportCommercemlParser($filename);
        }

        if (strpos('offer', $filename) !== false) {
            return new OfferCommercemlParser($filename);
        }

        throw new InvalidArgumentException('Unknown filename for parsing given');
    }
}
