<?php

namespace App\Http\Controllers;

use App\Feed;
use Illuminate\Http\Request;

class ShowUserFeedController extends Controller
{
    public function show(Feed $feed)
    {
        return view('feeds.show', compact('feed'));
    }
}
