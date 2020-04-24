<?php

declare(strict_types=1);

namespace Domain\Commerce\Factory;

use App\Http\Requests\Request;
use Domain\Commerce\HttpSteps\AuthStep;
use Domain\Commerce\HttpSteps\FileStep;
use Domain\Commerce\HttpSteps\ImportStep;
use Domain\Commerce\HttpSteps\InitStep;
use Domain\Commerce\HttpSteps\Step;
use Domain\Commerce\Services\HelpFileCommerceService;
use InvalidArgumentException;

final class ImportSimpleFactory
{
    /**
     * @param Request $request
     * @param HelpFileCommerceService $helpFileCommerceService
     * @return Step
     */
    public static function factory(Request $request, HelpFileCommerceService $helpFileCommerceService): Step
    {
        $step = $request->get('mode');

        if ($step === 'checkauth') {
            return new AuthStep($request, $helpFileCommerceService);
        }

        if ($step === 'init') {
            return new InitStep($request, $helpFileCommerceService);
        }

        if ($step === 'file') {
            return new FileStep($request, $helpFileCommerceService);
        }

        if ($step === 'import') {
            return new ImportStep($request, $helpFileCommerceService);
        }

        throw new InvalidArgumentException('Unknown step given');
    }
}
