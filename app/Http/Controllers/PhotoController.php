<?php

namespace App\Http\Controllers;

use App\Feed;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function create(Feed $feed)
    {
        return view('photos.create',compact('feed'));
    }

    public function store(Feed $feed) //TODO refactor this
    {
        $path = \request()->file('photo')->store('public/photos');
        $feed->photos()->create([
            'path'=>\request()->file('photo')->hashName()
        ]);

        return redirect()->route('feeds.show',$feed->id);
    }
}
