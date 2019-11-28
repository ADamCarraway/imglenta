@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                @foreach($feeds as $feed)
                    {{ $feed->title }}
                    {{ $feed->info }}
                @endforeach
            </div>
        </div>
    </div>
@endsection
