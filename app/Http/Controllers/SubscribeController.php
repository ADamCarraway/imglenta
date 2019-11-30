<?php

namespace App\Http\Controllers;

use App\Feed;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function store(Feed $feed)
    {
        auth()->user()->subscribe($feed);

        return back();
    }

    public function destroy(Feed $feed)
    {
        auth()->user()->unsubscribe($feed);

        return back();
    }
}
