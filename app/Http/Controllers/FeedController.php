<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Http\Requests\StoreFeedRequest;
use App\Http\Requests\UpdateFeedRequest;

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

        return redirect()->route('feeds.index')->with('success', 'Your feed is created');
    }

    public function show(Feed $feed)
    {
        $this->authorize('manage', $feed);

        return view('feeds.show', compact('feed'));
    }

    public function edit(Feed $feed)
    {
        $this->authorize('manage', $feed);

        return view('feeds.edit', compact('feed'));
    }

    public function update(UpdateFeedRequest $request, Feed $feed)
    {
        $this->authorize('manage', $feed);

        $feed->update($request->validated());

        return redirect()->route('feeds.show', $feed)->with('success', 'Feed data changed.');
    }

    public function destroy(Feed $feed)
    {
        $this->authorize('manage', $feed);

        if (auth()->user()->feeds()->count() == 1) {
            return redirect()->route('feeds.index')->with('error', 'You cannot delete the last feed');
        }

        $feed->delete();

        return redirect()->route('feeds.index')->with('success', 'Feed is delete');
    }
}
