<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Http\Requests\StoreFeedRequest;
use App\User;

class FeedController extends Controller
{
    public function index()
    {
        $feeds = auth()->user()->feeds()->get();

        return view('feeds.index', compact('feeds'));
    }

    public function create()
    {
        return view('feeds.create');
    }

    public function store(StoreFeedRequest $request)
    {
        auth()->user()->feeds()->create($request->validated());

        return redirect()->route('feeds.create');
    }

    public function destroy(Feed $feed)
    {
        $this->authorize('manage', $feed);

        $feed->delete();
    }

    public function show(Feed $feed)
    {
        $this->authorize('manage', $feed);

        return view('feeds.show',compact('feed'));
    }
}
