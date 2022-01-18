<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Users;

class LoginController extends Controller
{
    //

    public function login()
    {
        return view('home');
    }

    public function signin(Request $request)
    {
        $user = Users::where('user_id', $request->userid)->first();

        if($user)    //  found a group user.
        {             
            $user_id = $request->user_id;
            return  view('menu',compact('user_id'));          //view('menu')->with('user_id',$user_id);  
        }
        else{
            $new_user = new Users();
			$new_user->user_id = (int)$request->userid;
			$new_user->save();
            $user_id = $request->user_id;
            return view('menu',compact('user_id'));          //view('menu')->with('user_id',$user_id);     
        }   
    }
}