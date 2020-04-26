<?php

declare(strict_types=1);

namespace Domain\Commerce\Parsers;

abstract class CommercemlParser
{
    /**
     * @var string
     */
    protected $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    abstract public function parse(): void;
}
