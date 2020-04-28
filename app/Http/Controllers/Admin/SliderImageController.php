<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Slider\Queries\GetSliderByIdQuery;
use Domain\SliderImage\Commands\CreateSliderImageCommand;
use Domain\SliderImage\Commands\DeleteSliderImageCommand;
use Domain\SliderImage\Commands\UpdatePositionsSliderImageCommand;
use Domain\SliderImage\Commands\UpdateSliderImageCommand;
use Domain\SliderImage\Queries\GetSliderImageByIdQuery;
use App\Http\Controllers\Controller;
use App\Services\UploadImagesService;
use Domain\SliderImage\Requests\CreateSliderImageRequest;
use Domain\SliderImage\Requests\UpdateSliderImageRequest;
use Illuminate\Http\Request;
use Throwable;

/**
 * Class SliderImageController
 * @package App\Http\Controllers\Admin
 */
class SliderImageController extends Controller
{
    /**
     * @var UploadImagesService
     */
    private $uploadSliderImagesService;

    /**
     * SliderImageController constructor.
     * @param UploadImagesService $uploadSliderImagesService
     */
    public function __construct(UploadImagesService $uploadSliderImagesService)
    {
        $this->uploadSliderImagesService = $uploadSliderImagesService;
    }

    /**
     * @param int $gallery
     * @return array
     * @throws Throwable
     */
    public function index(int $gallery): array
    {
        $slider = $this->dispatch(new GetSliderByIdQuery($gallery));

        return [
            'images' => view('admin.sliders._images_box', [
                'slider' => $slider
            ])->render()
        ];
    }

    /**
     * @param CreateSliderImageRequest $request
     * @param int $slider
     * @return array
     */
    public function store(CreateSliderImageRequest $request, int $slider): array
    {
        $image = $this->uploadSliderImagesService->setWidthThumb(250)->upload($request, 'slider', $slider);
        $this->dispatch(new CreateSliderImageCommand($image));

        return [
            'message' => 'Данные сохранены успешно'
        ];
    }

    /**
     * @param int $id
     * @return string
     * @throws Throwable
     */
    public function edit(int $id): string
    {
        $image = $this->dispatch(new GetSliderImageByIdQuery($id));

        return view('admin.sliders._image_popup', [
            'image' => $image
        ])->render();
    }

    /**
     * @param int $id
     * @param UpdateSliderImageRequest $request
     * @return array
     * @throws Throwable
     */
    public function update(int $id, UpdateSliderImageRequest $request): array
    {
        $this->dispatch(new UpdateSliderImageCommand($id, $request));

        $image = $this->dispatch(new GetSliderImageByIdQuery($id));
        $slider = $this->dispatch(new GetSliderByIdQuery($image->slider_id));

        return [
            'images' => view('admin.sliders._images_box', [
                'slider' => $slider
            ])->render(),
            'message' => 'Данные сохранены успешно'
        ];
    }

    /**
     * @param int $id
     * @return array|string[]
     */
    public function destroy(int $id): array
    {
        $this->dispatch(new DeleteSliderImageCommand($id));

        return [
            'message' => 'Изображение удалено успешно'
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function updatePositions(Request $request): array
    {
        $this->dispatch(new UpdatePositionsSliderImageCommand($request));

        return [
            'message' => 'Порядок изображений сохранён успешно'
        ];
    }
}
