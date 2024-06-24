<x-layout>
  <div class="container py-md-5 container--narrow">

      <form action="/updatePost/{{$post->id}}" method="POST">
        <p><small><strong><a href="/post/{{$post->id}}">Back</a></strong></small></p>
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
          <input  name="title" id="post-title"  value ="{{old('title', $post->title)}}" class="form-control form-control-lg form-control-title" type="text" placeholder="" autocomplete="off" />
          @error('title')
              <p class=" m-0 small alert alert-danger shadow-sm">{{$message}}</p>
              @enderror
        </div>

        <div class="form-group">
    <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
    <textarea name="body" id="post-body" class="body-content tall-textarea form-control">{{ old('body', $post->body) }}</textarea>
    @error('body')
        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
    @enderror
</div>


        <button class="btn btn-primary">Edit New Post</button>
      </form>
    </div>
</x-layout>