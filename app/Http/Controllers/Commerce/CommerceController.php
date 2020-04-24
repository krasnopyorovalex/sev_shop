<?php

declare(strict_types=1);

namespace App\Http\Controllers\Commerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommerceRequest;
use Domain\Commerce\Factory\ExportSimpleFactory;
use Domain\Commerce\Factory\ImportSimpleFactory;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Log;

class CommerceController extends Controller
{
    /**
     * @param CommerceRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function __invoke(CommerceRequest $request)
    {
        Log::info($request->getQueryString());

        try {
            $step = $request->get('type') === 'catalog'
                ? ImportSimpleFactory::factory($request)
                : ExportSimpleFactory::factory($request);

            $step->handle();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response(sprintf('%s'.PHP_EOL.'%s', 'failure', $exception->getMessage()));
        }

        return response($step->getStatus());
    }
}
