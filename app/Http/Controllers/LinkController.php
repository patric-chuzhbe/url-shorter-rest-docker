<?php

namespace App\Http\Controllers;

use App\Models\Link;

class LinkController extends Controller
{
    /**
     * @param string $prefix
     * @return \Illuminate\Http\RedirectResponse
     */
    public function away(string $suffix)
    {
        $link = Link::where(['short_url_suffix' => $suffix])->firstOrFail();
        return redirect()->away($link->url_to_short);
    }
}
