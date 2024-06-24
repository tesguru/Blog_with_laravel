<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function profile(User $post){ 
        //look it base on username not id because Id is a default
        return view("profile-post",
        ['name'=>$post->name,
         'post'=>$post->userHasManyPost()->latest()->get(),
        'post_count'=>$post->userHasManyPost()->count()]);
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
    public function updateAvatar(Request $request){
        $request ->validate(
            [
                'avatar'=>'required|image|max:6000'
            ]
            );

            $filename 
$img = $request->file('avatar')->store('public/avatar');

    }
}
