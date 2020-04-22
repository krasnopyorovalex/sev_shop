<?php

declare(strict_types=1);

namespace App\Http\Controllers\Commerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommerceRequest;
use Domain\Commerce\Factory\StepSimpleFactory;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class CommerceController extends Controller
{
    /**
     * @param CommerceRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function __invoke(CommerceRequest $request)
    {

        \Log::info((string)$request->headers);

        try {
            $step = StepSimpleFactory::factory($request->get('mode'));

            $step->handle();
        } catch (Exception $exception) {
            return response($exception->getMessage());
        }

        return response($step->getStatus());
    }
}
