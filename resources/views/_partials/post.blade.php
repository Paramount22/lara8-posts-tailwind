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
                            <button type="submit" class="bg-red-400 mt-2 mb-2 text-white p-1 rounded
                                        text-xs">Delete</button>
                        </form>
                    @endcan
                @endauth

            </div>
            <a href="{{route('posts.show', $post)}}" class="mb-2 text-gray-500 text-sm hover:text-gray-700">detail</a>
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
