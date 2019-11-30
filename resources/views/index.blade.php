@extends('layouts.app')

@section('content')
    <div class="container col-md-6">
        @foreach($photos as $photo)
            @include('layouts.photo')
            <br>
        @endforeach
    </div>
@endsection
