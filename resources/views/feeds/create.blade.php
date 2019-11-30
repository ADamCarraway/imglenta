@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">
                Creating a feed
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
        <form method="post" action="{{ route('feeds.store') }}">
            @csrf
            <div class="">
                <label>Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <br>
            <div class="">
                <label>Description</label>
                <textarea type="text" name="info" class="form-control"></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">
                Сreate
            </button>
        </form>
            </div>
        </div>
    </div>
@endsection
