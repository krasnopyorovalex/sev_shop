<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Slider\Commands\CreateSliderCommand;
use Domain\Slider\Commands\DeleteSliderCommand;
use Domain\Slider\Commands\UpdateSliderCommand;
use Domain\Slider\Queries\GetAllSlidersQuery;
use Domain\Slider\Queries\GetSliderByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Slider\Requests\CreateSliderRequest;
use Domain\SliderImage\Requests\UpdateSliderImageRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $sliders = $this->dispatch(new GetAllSlidersQuery());

        return view('admin.sliders.index', [
            'sliders' => $sliders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSliderRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateSliderRequest $request)
    {
        $this->dispatch(new CreateSliderCommand($request));

        return redirect(route('admin.sliders.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|Response|View
     */
    public function edit($id)
    {
        $slider = $this->dispatch(new GetSliderByIdQuery($id));

        return view('admin.sliders.edit', [
            'slider' => $slider
        ]);
    }

    /**
     * @param $id
     * @param UpdateSliderImageRequest $request
     * @return RedirectResponse
     */
    public function update($id, UpdateSliderImageRequest $request): RedirectResponse
    {
        $this->dispatch(new UpdateSliderCommand($id, $request));

        return redirect(route('admin.sliders.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteSliderCommand($id));

        return redirect(route('admin.sliders.index'));
    }
}
