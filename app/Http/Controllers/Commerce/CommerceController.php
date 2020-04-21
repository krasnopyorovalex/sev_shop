<?php

declare(strict_types=1);

namespace App\Http\Controllers\Commerce;

use App\Http\Controllers\Controller;

class CommerceController extends Controller
{
    public function import()
    {
        $cookieName = 'test';
        $cookieValue = 'ascasc';

        return response('success' . PHP_EOL . $cookieName . PHP_EOL . $cookieValue);
    }
}
