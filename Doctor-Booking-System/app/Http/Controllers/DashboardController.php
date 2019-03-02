<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Customer;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $allPosts = Customer::orderBy('created_at', 'desc')->paginate(10);
        if($user->isAdmin()){

            $data = array(
                'success'=>'Inside admin section',
                'posts'=> $allPosts,
                );
            
            return view('auth.admin')->with($data);
          
        }
        return view('dashboard')->with('posts', $user->posts);
    }
}
