<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Catalog\Commands\CreateCatalogCommand;
use Domain\Catalog\Commands\DeleteCatalogCommand;
use Domain\Catalog\Commands\UpdateCatalogCommand;
use Domain\Catalog\Queries\GetAllCatalogsNotParentQuery;
use Domain\Catalog\Queries\GetAllCatalogsQuery;
use Domain\Catalog\Queries\GetCatalogByIdQuery;
use App\Http\Controllers\Controller;
use App\Services\TreeRecursiveBuildService;
use Domain\Catalog\Requests\CreateCatalogRequest;
use Domain\Catalog\Requests\UpdateCatalogRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * @property  treeRecursiveBuildService
 */
class CatalogController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $catalogs = $this->dispatch(new GetAllCatalogsNotParentQuery());

        return view('admin.catalogs.index', [
            'catalogs' => $catalogs
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $catalogs = $this->dispatch(new GetAllCatalogsQuery());

        return view('admin.catalogs.create', [
            'catalogs' => $catalogs
        ]);
    }

    /**
     * @param CreateCatalogRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateCatalogRequest $request)
    {
        $this->dispatch(new CreateCatalogCommand($request));

        return redirect(route('admin.catalogs.index'));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $catalog = $this->dispatch(new GetCatalogByIdQuery($id));
        $catalogs = $this->dispatch(new GetAllCatalogsQuery($catalog));

        return view('admin.catalogs.edit', [
            'catalog' => $catalog,
            'catalogs' => $catalogs
        ]);
    }

    /**
     * @param int $id
     * @param UpdateCatalogRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateCatalogRequest $request)
    {
        $this->dispatch(new UpdateCatalogCommand($id, $request));

        return redirect(route('admin.catalogs.index'));
    }

    /**
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteCatalogCommand($id));

        return redirect(route('admin.catalogs.index'));
    }
}
