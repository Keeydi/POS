<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware\HandleInertiaRequests;

class HandleInertiaRequests extends HandleInertiaRequests
{
    protected $rootView = 'app';

    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
        ];
    }
}
