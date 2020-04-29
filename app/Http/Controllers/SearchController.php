<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\SearchService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * @var SearchService
     */
    private $searchService;

    /**
     * ImportController constructor.
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * @param SearchRequest $request
     * @return Application|Factory|View
     */
    public function __invoke(SearchRequest $request)
    {
        $catalogProducts = $this->searchService->search($request->keyword);

        return view('search.index', ['products' => $catalogProducts]);
    }
}
