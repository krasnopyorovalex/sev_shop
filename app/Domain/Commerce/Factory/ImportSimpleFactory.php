<?php

declare(strict_types=1);

namespace Domain\Commerce\Factory;

use App\Http\Requests\Request;
use Domain\Commerce\HttpSteps\AuthStep;
use Domain\Commerce\HttpSteps\FileStep;
use Domain\Commerce\HttpSteps\InitStep;
use Domain\Commerce\HttpSteps\Step;
use InvalidArgumentException;
use Log;

final class ImportSimpleFactory
{
    /**
     * @param Request $request
     * @return Step
     */
    public static function factory(Request $request): Step
    {
        $step = $request->get('mode');

        Log::info($request->get('mode'));

        if ($step === 'checkauth') {
            return new AuthStep($request);
        }

        if ($step === 'init') {
            return new InitStep($request);
        }

        if ($step === 'file') {
            return new FileStep($request);
        }

        throw new InvalidArgumentException('Unknown step given');
    }
}
