<x-profile :name="$name" :currently-following="$currentlyFollowing" :post="$post">
    <div class="list-group">
  
        @foreach ($post as $getPost)
            <a href="/post/{{ $getPost->id }}" class="list-group-item list-group-item-action">
                <img class="avatar-tiny" src="https://gravatar.com/avatar/b9408a09298632b5151200f3449434ef?s=128" alt="User avatar" />
                <strong>{{ $getPost->title }}</strong> on {{ $getPost->created_at->format('Y-m-d') }}
            </a>
        @endforeach
    </div>
</x-profile>