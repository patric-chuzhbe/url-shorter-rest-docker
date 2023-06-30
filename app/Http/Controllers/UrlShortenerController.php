<?php

namespace App\Http\Controllers;

use App\Service\LinkService;
use Illuminate\Http\Request;

class UrlShortenerController extends Controller
{
    public function shorten(Request $request, LinkService $service)
    {
        $request->validate([
            'urlToShort' => 'required|url',
        ]);

        return [
            'shortedUrl' => env('APP_URL')
                . '/link/'
                . $service->getShortUrlSuffix($request->input('urlToShort'))
        ];
    }
}
