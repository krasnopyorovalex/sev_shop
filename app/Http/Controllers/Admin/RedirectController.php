<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Redirect\Commands\CreateRedirectCommand;
use Domain\Redirect\Commands\DeleteRedirectCommand;
use Domain\Redirect\Commands\UpdateRedirectCommand;
use Domain\Redirect\Queries\GetAllRedirectsQuery;
use Domain\Redirect\Queries\GetRedirectByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Redirect\Requests\CreateRedirectRequest;
use Domain\Redirect\Requests\UpdateRedirectRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class RedirectController
 * @package App\Http\Controllers\Admin
 */
class RedirectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $redirects = $this->dispatch(new GetAllRedirectsQuery);

        return view('admin.redirects.index', [
            'redirects' => $redirects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('admin.redirects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRedirectRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateRedirectRequest $request)
    {
        $this->dispatch(new CreateRedirectCommand($request));

        return redirect(route('admin.redirects.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|Response|View
     */
    public function edit($id)
    {
        $redirect = $this->dispatch(new GetRedirectByIdQuery($id));

        return view('admin.redirects.edit', [
            'redirect' => $redirect
        ]);
    }

    /**
     * @param $id
     * @param UpdateRedirectRequest $request
     * @return RedirectResponse
     */
    public function update($id, UpdateRedirectRequest $request)
    {
        $this->dispatch(new UpdateRedirectCommand($id, $request));

        return redirect(route('admin.redirects.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteRedirectCommand($id));

        return redirect(route('admin.redirects.index'));
    }
}
