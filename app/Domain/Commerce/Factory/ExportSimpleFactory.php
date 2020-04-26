<?php

declare(strict_types=1);

namespace Domain\Commerce\Factory;

use App\Http\Requests\Request;
use Domain\Commerce\HttpSteps\AuthStep;
use Domain\Commerce\HttpSteps\InitExportStep;
use Domain\Commerce\HttpSteps\QueryStep;
use Domain\Commerce\HttpSteps\Step;
use Domain\Commerce\HttpSteps\SuccessStep;
use InvalidArgumentException;

final class ExportSimpleFactory
{
    /**
     * @param Request $request
     * @return Step
     */
    public static function factory(Request $request): Step
    {
        $step = $request->get('mode');

        if ($step === 'checkauth') {
            return new AuthStep($request);
        }

        if ($step === 'init') {
            return new InitExportStep($request);
        }

        if ($step === 'query') {
            return new QueryStep($request);
        }

        if ($step === 'success') {
            return new SuccessStep($request);
        }

        throw new InvalidArgumentException('Unknown step given');
    }
}
