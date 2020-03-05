@extends('layouts.app')

@section('content')
    @forelse($photos as $photo)
        @include('layouts.photo')
        <br>
    @empty
        <div class="alert alert-info" role="alert">
            No photos yet
        </div>
    @endforelse
@endsection
