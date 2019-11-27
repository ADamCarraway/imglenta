@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Добавление фото</h4>
        <br>
        <form class="" action="{{ route('items.create') }}" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <div class="form-inline ">
                Категория
                <select class="form-control ml-2" name="feed_id" required>
{{--                    @foreach($feeds as $item)--}}
{{--                        @if($item->active == 1)--}}
{{--                            <option selected value="{{ $item->id }}">{{ $item->title }}</option>--}}
{{--                        @else--}}
{{--                            <option value="{{ $item->id }}">{{ $item->title }}</option>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
                </select>
            </div>
            <br>
            <div class="form-group">
                <label>Фото</label>
                <input type="file" name="image" accept="image/*" >
            </div>
            <button type="submit" class="btn btn-primary">Загрузить</button>
        </form>
    </div>
@endsection
