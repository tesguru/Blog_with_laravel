<x-layout>
  <div class="container py-md-5 container--narrow">
      <form action="/createPost" method="POST">
        @csrf
        <div class="form-group">
          <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
          <input  name="title" id="post-title"  value ="{{old('title')}}" class="form-control form-control-lg form-control-title" type="text" placeholder="" autocomplete="off" />
          @error('title')
              <p class=" m-0 small alert alert-danger shadow-sm">{{$message}}</p>
              @enderror
        </div>

        <div class="form-group">
          <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
          <textarea  name="body" value ="{{old('body')}}" id="post-body" class="body-content tall-textarea form-control" type="text"></textarea>
          @error('body')
              <p class=" m-0 small alert alert-danger shadow-sm">{{$message}}</p>
              @enderror
        </div>

        <button class="btn btn-primary">Save New Post</button>
      </form>
    </div>
</x-layout>