<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FollowsController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    public function store(User $user){
           $users = Auth::User();
        //    return $user->username;
        // $s = $users->following()->toggle($users->profile);
        return $users->following()->toggle($user->profile);
           
    }
}
