@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @auth
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

            @endauth

            @if($posts->count())
                @foreach($posts as $post)
                    <div class="mb-4 p-4  border-dashed border-2 border-light-blue-500">
                       <p class="text-gray-600">
                           {{$post->body}}
                       </p>
                        <div class="mt-2">
                            <a href="{{route('users.posts', $post->user)}}" class="text-gray-400 font-bold text-sm ">
                                {{$post->user->username}} </a>
                            <time datetime="{{$post->created_at->toW3cString()}}" class="px-2 text-gray-600 text-sm">
                                {{ $post->created_at->diffForHumans() }}
                            </time>
                            @auth
                                @can('delete', $post)
                                <form action="{{route('posts.destroy', $post)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-400 mt-2 text-white p-1 rounded
                                        text-xs">Delete</button>
                                </form>
                                @endcan
                            @endauth
                        </div>
                        <div class="flex items-center mt-2">
                            @auth
                                @if(! $post->likedBy( auth()->user() ))
                                <form action="{{route('posts.likes', $post->id)}}" method="post" class="mr-1">
                                    @csrf
                                    <button type="submit" class="text-blue-400">
                                        <i class="fas fa-thumbs-up relative"></i>
                                    </button>
                                </form>
                            @endif
                            @endauth

                            @auth
                            @if(! $post->unlikedBy( auth()->user() ))
                            <form action="{{route('posts.unlikes', $post->id)}}" method="post" class="mr-1 px-3">
                                @csrf
                                <button type="submit" class="text-blue-400">
                                    <i class="fas fa-thumbs-down relative"></i>
                                </button>
                            </form>
                            @endif

                            @endauth

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
