@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                My feeds
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @foreach($feeds as $feed)
                        <div class="list-group-item">
                           <div class="row">
                               <div class="col-2">
                                   <a href="{{ route('feeds.show',$feed->id) }}">
                                       {{ $feed->title }}
                                   </a>
                               </div>
                               <div class="col-6">
                                   {{ $feed->info }}
                               </div>
                               <div class="col-4">
                                   <div class="flex justify-content-between">
                                       <form action="{{ route('feeds.destroy', $feed) }}" method="post" class="d-inline-flex">
                                           @csrf
                                           @method('DELETE')
                                           <button type="submit" class="btn btn-link">
                                               Remove
                                           </button>
                                       </form>
                                       <a href="{{ route('feeds.edit',$feed->id) }}">
                                           To change
                                       </a>
                                   </div>
                               </div>
                           </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
