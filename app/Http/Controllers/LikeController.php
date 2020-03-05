<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Like;
use App\Photo;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Feed $feed, Photo $photo)
    {
        auth()->user()->like($photo);

        return back();
    }

    public function destroy(Feed $feed, Photo $photo)
    {
        auth()->user()->unlike($photo);

        return back();
    }
}
