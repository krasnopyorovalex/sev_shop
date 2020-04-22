<?php

declare(strict_types=1);

namespace Domain\Commerce\Factory;

use Domain\Commerce\HttpSteps\AuthStep;
use Domain\Commerce\HttpSteps\InitStep;
use Domain\Commerce\HttpSteps\Step;
use InvalidArgumentException;

final class StepSimpleFactory
{
    /**
     * @param string $step
     * @return Step
     */
    public static function factory(string $step): Step
    {
        if ($step === 'checkauth') {
            return new AuthStep;
        }

        if ($step === 'init') {
            return new InitStep;
        }

        throw new InvalidArgumentException('Unknown format given');
    }
}
