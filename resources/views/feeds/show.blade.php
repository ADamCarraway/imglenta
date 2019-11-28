@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                {{ $feed->title }}
            </div>
            <div class="card-body">
                <p>
                    {{ $feed->info }}
                </p>
            </div>
        </div>
    </div>
@endsection
