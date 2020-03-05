<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Photo;
use Illuminate\Http\Request;

class ShowUserFeedController extends Controller
{

    public function index()
    {
        $photos = Photo::latest()->get();

        return view('index', compact('photos'));
    }

    public function show(Feed $feed)
    {
        return view('feeds.show', compact('feed'));
    }
}
