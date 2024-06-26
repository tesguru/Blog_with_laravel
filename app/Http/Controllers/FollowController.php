<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
  public function createFollow(User $user){
    if($user->id === auth()->user()->id ){
        return back()->with('failure', 'You can\'t follow yourself');
    }
    $existingCheck = Follow::where([['user_id', '=', auth()->user()->id],['followedUser', '=', $user->id ] ])->count();
    if($existingCheck){
        return back()->with('failure', 'You have already followed this person');
    }
$newFollow = new Follow();
$newFollow->user_id = auth()->user()->id;
$newFollow->followedUser = $user->id;
$newFollow->save();
return back()->with('success', 'user Successfully followed');
  }
  public function removeFollow(User $user){
    Follow::where([['user_id', '=', auth()->user()->id], ['followedUser', '=', $user->id]])->delete();
return back()->with('success', 'Done successfully');
  }
}
