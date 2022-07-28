@props(['post' => $post])

<div class="mb-4">
    <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name}}</a>
    <span class="text-gray-600 text-sm">{{$post->created_at->diffForHumans()}}</span>

    <p class="mb-2">{{ $post->body}}</p>
    @can('delete', $post)
        <form action="{{ route('posts.destroy1', $post) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="text-red-500">DELETE</button>
        </form>
    @endcan
    

    <div class="flex items-center">
        @auth
            @if (!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.likes', $post) }}" method="POST" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>
            @else                           
            {{-- <span class="mr-1">{{ $post->likes->count()}}</span> --}}
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-500">Dislike</button>
                </form>
            @endif

            {{-- <form action="" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500">DELETE</button>
            </form> --}}
        @endauth
        
        <span class="mr-1">{{ $post->likes->count()}} {{ Str::plural('like', $post->likes->count())}}</span>

    </div>
</div>