<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UserController extends Controller
{

    public function profile(User $post)
{
    $currentlyFollowing = 0;
    if (auth()->check()) {
        $currentlyFollowing = Follow::where([
            ['user_id', '=', auth()->user()->id],
            ['followedUser', '=', $post->id]
        ])->count();
    }

    $posts = $post->userHasManyPost()->latest()->get();
    $post_count = $posts->count();
  

    return view("profile-post", [
        'name' => $post->name,
        'currentlyFollowing' => $currentlyFollowing,
        'post' => $posts,
        'postCount' => $post_count
    ]);
}


    public function showCorrectHomepage(){
       if(auth()->check()){
      return  view ('homepage-feeds');
       }
       else{
 return view('home');
       }
    }
    public function Register(Request $request){
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:25', Rule::unique('users', 'name')],
            'email' => ['required',  'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'Confirmed'],
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        //to login user directly after creating
        auth()->login($user);
        return    redirect('/')->with('success', 'Thank you for creating a new User');
    }

    public function login(Request $request){
        $incomingFields = $request->validate([
      'loginname'=>'required',
      'loginpassword'=>'required',
        ]);

        if(auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])){
            $request->session()->regenerate();
            //if the what the user send is correct send a cookie with id to show that thye are logged in
            return    redirect('/')->with('success', 'You have successfully logged in');
        }
        else{
            return    redirect('/')->with('failure', 'Invalid login');;
        }

    }

    public function logout(){
        auth()->logout();
    return    redirect('/')->with('success', 'you are now Logged out');
    }

    public function showAvatarForm(){
        return view('avatar-form');
    }
    public function profileFollowers(User $post){
    return   $post->followers()->latest()->get();
        die;
        $currentlyFollowing = 0;
        if (auth()->check()) {
            $currentlyFollowing = Follow::where([
                ['user_id', '=', auth()->user()->id],
                ['followedUser', '=', $post->id]
            ])->count();
        }
    
        $posts = $post->userHasManyPost()->latest()->get();
        $post_count = $posts->count();
      
    
        return view("profile-followers", [
            'name' => $post->name,
            'currentlyFollowing' => $currentlyFollowing,
            'post' => $posts,
            'postCount' => $post_count
        ]);
    }
    public function profileFollowing(User $post){
        $currentlyFollowing = 0;
        if (auth()->check()) {
            $currentlyFollowing = Follow::where([
                ['user_id', '=', auth()->user()->id],
                ['followedUser', '=', $post->id]
            ])->count();
        }
    
        $posts = $post->userHasManyPost()->latest()->get();
        $post_count = $posts->count();
      
    
        return view("profile-following", [
            'name' => $post->name,
            'currentlyFollowing' => $currentlyFollowing,
            'post' => $posts,
            'postCount' => $post_count
        ]);
    }
}
