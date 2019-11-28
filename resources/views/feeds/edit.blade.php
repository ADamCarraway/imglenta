@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">
                Создание ленты
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
                        <label>Название</label>
                        <input type="text" name="title" class="form-control" value="{{ $feed->title }}">
                    </div>
                    <br>
                    <div class="">
                        <label>Описание</label>
                        <textarea type="text" name="info" class="form-control">{{ $feed->info }}</textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">
                        Изменить
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
