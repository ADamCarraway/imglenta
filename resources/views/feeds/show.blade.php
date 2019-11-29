@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-lg-between">
                    {{ $feed->title }}
                    <div>
                        @can('manage', $feed)
                            <a href="{{ route('photos.create',$feed) }}" class="btn btn-link">
                                Добавить фотто
                            </a>
                        @endcan
                        @if(auth()->id() != $feed->user_id)
                            @if($feed->isSubscriber())
                                <form action="{{ route('feeds.unsubscribe', $feed) }}" method="post"
                                      class="d-inline-flex float-right">
                                    @method("DELETE")
                                    @csrf
                                    <button type="submit" class="btn btn-link">
                                        Отписаться
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('feeds.subscribe', $feed) }}" method="post"
                                      class="d-inline-flex float-right">
                                    @csrf
                                    <button type="submit" class="btn btn-link">
                                        Подписаться
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
        <div class="col-md-6 m-auto">
            @foreach($feed->photos as $photo)
                <div class="card md-6">
                    <img class="card-img-top" src="{{ asset('storage/photos/'.$photo->path) }}" alt="Card image cap">
                    <div class="card-body">
                        @if($photo->isLike())
                            <form action="{{ route('photos.unlike', [$feed,$photo]) }}" method="post"
                                  class="d-inline-flex float-right">
                                @method("DELETE")
                                @csrf
                                <button type="submit" class="btn btn-link">
                                    Дизлайк
                                    {{ $photo->likes_count }}
                                </button>
                            </form>
                        @else
                            <form action="{{ route('photos.like', [$feed,$photo]) }}" method="post"
                                  class="d-inline-flex float-right">
                                @csrf
                                <button type="submit" class="btn btn-link">
                                    Лайк
                                    {{ $photo->likes_count }}
                                </button>
                            </form>
                        @endif
                        @can('manage', $feed)
                            <form action="{{ route('photos.destroy', [$feed,$photo]) }}" method="post"
                                  class="d-inline-flex float-left">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link">
                                    Удалить
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    </div>
@endsection
