@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            Feed editing
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('feeds.update', $feed) }}">
                @csrf
                @method('PUT')
                <div class="">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $feed->title }}">
                </div>
                <br>
                <div class="">
                    <label>Description</label>
                    <textarea type="text" name="info" class="form-control">{{ $feed->info }}</textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">
                    Change
                </button>
            </form>
        </div>
    </div>
@endsection
