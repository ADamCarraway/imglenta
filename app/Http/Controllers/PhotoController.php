<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Http\Requests\StoreFeedRequest;
use App\Http\Requests\StorePhotoRequest;
use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function create(Feed $feed)
    {
        return view('photos.create',compact('feed'));
    }

    public function store(Feed $feed, StorePhotoRequest $request) //TODO refactor this
    {
        $request->validated();
        $path = \request()->file('photo')->store('public/photos');
        $feed->photos()->create([
            'path'=>\request()->file('photo')->hashName()
        ]);

        return redirect()->route('feeds.show',$feed->id)->with('success','Your image is uploaded!');
    }

    public function destroy(Feed $feed, Photo $photo)
    {
        $photo->delete();

        return redirect()->route('feeds.show',$feed->id)->with('success','Photo deleted');
    }
}
