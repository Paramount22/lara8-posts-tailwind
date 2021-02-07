@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
           <h1 class="text-center text-2xl mb-3">{{$user->name}}</h1>
            <p class="mb-2">Posted {{$posts->count()}} {{Str::plural('post', $posts->count())}}
                and recieved {{$user->receivedLikes->count()}} likes
            </p>
            @include('_partials.post')
        </div>
    </div>
@endsection
