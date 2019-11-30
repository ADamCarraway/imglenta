@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">
                Adding photos
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
                <form method="post" action="{{ route('photos.store',$feed) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                        <label>Select photo</label><br>
                        <input type="file" name="photo">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">
                        Add
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
