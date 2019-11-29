<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Http\Requests\StorePhotoRequest;
use App\Photo;

class PhotoController extends Controller
{
    public function create(Feed $feed)
    {
        return view('photos.create', compact('feed'));
    }

    public function store(StorePhotoRequest $request, Feed $feed)
    {
        $request->file('photo')->store('public/photos');

        $feed->photos()->create(['path' => $request->file('photo')->hashName()]);

        return redirect()->route('feeds.show', $feed->id)->with('success', 'Your image is uploaded!');
    }

    public function destroy(Feed $feed, Photo $photo)
    {
        $this->authorize('manage', $feed);

        abort_if($photo->feed_id != $feed->id, 404);

        $photo->delete();

        return redirect()->route('feeds.show', $feed->id)->with('success', 'Photo deleted');
    }
}
