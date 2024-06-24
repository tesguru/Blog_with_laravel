<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PostController extends Controller
{
public function showCreateForm(){
    return view('create-post');
}
public function createPost(Request $request){
$incomingFields = $request->validate([
    'title' => 'required',
    'body' => 'required',
]);    
$incomingFields['title'] = strip_tags($incomingFields['title']);
$incomingFields['body'] = strip_tags($incomingFields['body']);
$incomingFields['user_id'] = auth()->id();
$newPost = Post::create($incomingFields);
return redirect("post/{$newPost->id}");
}
public function viewSinglePost(Post $post){
    // $ourHtml = Str::markdown($getPostById->body);
  
    return view ('single-post', ['post' => $post])->with('success', 'New post Created Successfully'); 
}


    public function deletePost(Post $post){
// if(auth()->user()->cannot('delete',$post)){
// return 'yes we can delete it';
// }using postpolicy in contoller
$post->delete();
return redirect ('/profile/'. auth()->user()->name)->with('success', 'Post Deleted Successfully');
    }
    public function viewEditForm(Post $post){
        
return view('edit-post', ['post' => $post]);
    }

    public function updatePost(Post $post, Request $request){
 $incomingFields = $request->validate([
    'title'=>'required',
    'body'=>'required'
 ]);
 
 $incomingFields['title'] = strip_tags($incomingFields['title']);
$incomingFields['body'] = strip_tags($incomingFields['body']);
$post->update($incomingFields);
return back()->with('success', 'Updated successfully');
    }

    public function storeAvatar(){
        
    }
}
