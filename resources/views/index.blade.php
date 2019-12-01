@extends('layouts.app')

@section('content')
    <div class="container col-md-6">
        @forelse($photos as $photo)
            @include('layouts.photo')
            <br>
        @empty
            <div class="alert alert-info" role="alert">
                No photos yet
            </div>
        @endforelse
    </div>
@endsection
