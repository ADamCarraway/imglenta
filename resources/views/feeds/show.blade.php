@extends('layouts.app')

@section('content')
    <div class="container col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-lg-between">
                    {{ $feed->user->name }}
                    >
                    {{ $feed->title }}
                    <div>
                        @can('manage', $feed)
                            <a href="{{ route('photos.create',$feed) }}" class="btn btn-link">
                                Add a photo
                            </a>
                        @endcan
                        @if(auth()->id() != $feed->user_id)
                            @if($feed->isSubscriber())
                                <form action="{{ route('feeds.unsubscribe', $feed) }}" method="post"
                                      class="d-inline-flex float-right">
                                    @method("DELETE")
                                    @csrf
                                    <button type="submit" class="btn btn-link">
                                        Subscribe
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('feeds.subscribe', $feed) }}" method="post"
                                      class="d-inline-flex float-right">
                                    @csrf
                                    <button type="submit" class="btn btn-link">
                                        Unsubscribe
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>
                    {{ $feed->info }}
                </p>
            </div>
        </div>
        <br>
        <div class="">
            @foreach($feed->photos as $photo)
                @include('layouts.photo')
                <br>
            @endforeach
        </div>
    </div>
@endsection
