<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Http\Requests\StoreFeedRequest;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except([]);
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
}
