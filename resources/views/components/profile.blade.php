<x-layout>
    <div class="container py-md-5 container--narrow">
        <h2>
            <img class="avatar-small" src="https://gravatar.com/avatar/b9408a09298632b5151200f3449434ef?s=128" /> {{ $name }}
            @auth
                @if (!$currentlyFollowing AND auth()->user()->name != $name)
                    <form class="ml-2 d-inline" action="/createFollow/{{ $name }}" method="POST">
                        @csrf
                        <button class="btn btn-primary btn-sm">Follow <i class="fas fa-user-plus"></i></button>
                    </form>
                @endif
                @if ($currentlyFollowing)
                    <form class="ml-2 d-inline" action="/removeFollow/{{ $name }}" method="POST">
                        @csrf
                        <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button>
                    </form>
                @endif
                @if (auth()->user()->name === $name)
                    <a href="/manageAvatar" class="btn btn-secondary">Manage Avatar</a>
                @endif
            @endauth
        </h2>

        <div class="profile-nav nav nav-tabs pt-2 mb-4">
            <a href="/profile/{{$name}}" class="profile-nav-link nav-item nav-link active">Posts:</a>
            <a href="/profile/{{$name}}/followers" class="profile-nav-link nav-item nav-link">Followers: 3</a>
            <a href="/profile/{{$name}}/following" class="profile-nav-link nav-item nav-link">Following: 2</a>
        </div>

        <div class="profile-content">
            {{ $slot }}
        </div>

    </div>
</x-layout>