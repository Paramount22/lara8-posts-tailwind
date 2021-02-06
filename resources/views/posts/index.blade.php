@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <form action="{{route('posts')}}" method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body"
                              class="bg-gray-100 border-2 w-full p-4 rounded-lg
                @error('body') border-red-500 @enderror" placeholder="Post something!"></textarea>

                    @error('body')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
                </div>
            </form>

            @if($posts->count())
                @foreach($posts as $post)
                    <div class="mb-4 p-4  border-dashed border-2 border-light-blue-500">
                       <p class="text-gray-600">
                           {{$post->body}}
                       </p>
                        <div class="mt-2">
                            <a href="" class="text-gray-400 font-bold text-sm "> {{$post->user->username}} </a>
                            <time datetime="{{$post->created_at->toW3cString()}}" class="px-2 text-gray-600 text-sm">
                                {{ $post->created_at->diffForHumans() }}
                            </time>
                        </div>
                        <div class="flex items-center mt-2">
                            @if(! $post->likedBy( auth()->user() ))
                            <form action="{{route('posts.likes', $post->id)}}" method="post" class="mr-1">
                                @csrf
                                <button type="submit" class="text-blue-400">
                                    <i class="fas fa-thumbs-up relative"></i>
                                </button>
                            </form>
                            @endif

                            @if(! $post->unlikedBy( auth()->user() ))
                            <form action="{{route('posts.unlikes', $post->id)}}" method="post" class="mr-1 px-3">
                                @csrf
                                <button type="submit" class="text-blue-400">
                                    <i class="fas fa-thumbs-down relative"></i>
                                </button>
                            </form>
                            @endif

                            @if($post->likes->count() > 0)
                               <span class="text-gray-600">{{$post->likes->count()}} {{-- {{Str::plural('like', $post->likes->count())
                               }}--}}
                                   <i class="fas fa-thumbs-up relative bottom-0.5"></i>
                               </span>
                            @endif

                            @if($post->unlikes->count() > 0)
                               <span class="mx-5 text-gray-600">{{$post->unlikes->count()}}
                                {{--{{Str::plural('unlike', $post->unlikes->count())}} --}}
                                   <i class="fas fa-thumbs-down relative top-0.5"></i>
                               </span>
                            @endif
                        </div>
                    </div>



                @endforeach
                    {{$posts->links()}}
            @else
                <p >No posts</p>
            @endif
        </div>
    </div>
@endsection
