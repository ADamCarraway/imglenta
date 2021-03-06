<div class="card md-6">
    <div class="card-header d-flex justify-content-between">
        <a href="{{ route('user.feeds.show', $photo->feed->id) }}">
            {{ $photo->feed->user->name }}
            >
            {{ $photo->feed->title }}
        </a>
        {{ $photo->created_at->diffForHumans() }}
    </div>
    <img class="card-img-top" src="{{ asset('storage/photos/'.$photo->path) }}" alt="Card image cap">
    <div class="card-body border-top">
        @if($photo->isLike())
            <form action="{{ route('photos.unlike', [$photo->feed, $photo]) }}" method="post"
                  class="d-inline-flex float-right">
                @method("DELETE")
                @csrf
                <button type="submit" class="btn btn-link">
                    Unlike
                    {{ $photo->likes_count }}
                </button>
            </form>
        @else
            <form action="{{ route('photos.like', [$photo->feed, $photo]) }}" method="post"
                  class="d-inline-flex float-right">
                @csrf
                <button type="submit" class="btn btn-link">
                    Like
                    {{ $photo->likes_count }}
                </button>
            </form>
        @endif
        @can('manage', $photo->feed)
            <form action="{{ route('photos.destroy', [$photo->feed, $photo]) }}" method="post"
                  class="d-inline-flex float-left">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-link">
                    Delete
                </button>
            </form>
        @endcan
    </div>
</div>
