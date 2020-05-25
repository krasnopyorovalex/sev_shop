<?php

namespace App\Http\Controllers;

use App\Http\Requests\Forms\ConsultationRequest;
use App\Http\Requests\Forms\RecallRequest;
use App\Mail\ConsultationSent;
use App\Mail\RecallSent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class FormHandlerController
 * @package App\Http\Controllers
 */
class FormHandlerController extends Controller
{
    use DispatchesJobs;

    /**
     * @param RecallRequest $request
     * @return array
     */
    public function recall(RecallRequest $request): array
    {
        Mail::to(explode(',', env('MAIL_TO')))->send(new RecallSent($request->validated()));

        return [
            'message' => 'Благодарим за Вашу заявку. Наш менеджер свяжется с Вами в ближайшее время',
            'status' => 200
        ];
    }

    /**
     * @param ConsultationRequest $request
     * @return array
     */
    public function consultation(ConsultationRequest $request): array
    {
        Mail::to(explode(',', env('MAIL_TO')))->send(new ConsultationSent($request->validated()));

        return [
            'message' => 'Благодарим за Вашу заявку. Наш менеджер свяжется с Вами в ближайшее время',
            'status' => 200
        ];
    }
}
