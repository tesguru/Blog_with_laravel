<x-layout>
  <div class="container py-md-5 container--narrow">
      <h2>
        <img class="avatar-small" src="https://gravatar.com/avatar/b9408a09298632b5151200f3449434ef?s=128" /> {{$name}}
        <form class="ml-2 d-inline" action="#" method="POST">
          <button class="btn btn-primary btn-sm">Follow <i class="fas fa-user-plus"></i></button>
          <!-- <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button> -->
           @if(auth()->user()->name === $name)
           <a href="/manageAvatar" class="btn btn-secondary">Manage Avatar</a>
           @endif
        </form>
      </h2>
      <div class="profile-nav nav nav-tabs pt-2 mb-4">
        <a href="#" class="profile-nav-link nav-item nav-link active">Post:{{$post_count}}</a>
        <a href="#" class="profile-nav-link nav-item nav-link">Followers: 3</a>
        <a href="#" class="profile-nav-link nav-item nav-link">Following: 2</a>
      </div>

      <div class="list-group">
      @foreach ($post as $getPost )
      <a href="/post/{{$getPost->id}}" class="list-group-item list-group-item-action">
          <img class="avatar-tiny" src="https://gravatar.com/avatar/b9408a09298632b5151200f3449434ef?s=128" />
          <strong>{{$getPost->title}}</strong> on {{$getPost->created_at->format('Y-m-d')}}
        </a>
      @endforeach
      </div>
    </div>
</x-layout>