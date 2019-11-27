@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" action="{{ route('feeds.store') }}">
            @csrf
            <div class="">
                <label>Название</label>
                <input type="text" name="title" class="form-control">
            </div>
            <br>
            <div class="">
                <label>Описание</label>
                <textarea type="text" name="info" class="form-control"></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">
                Создать
            </button>
        </form>

    </div>
@endsection
