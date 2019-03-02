<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Customer;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
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
        return redirect('/')->with('error', 'Unauthorized Page');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $this->validate($request, 
            ['name' => 'required',
            'description' => 'required',
            'doctor' => 'required']);

            // create customer 
            $cus = new Customer;
            $cus->name = $request->input('name');
            $cus->description = $request->input('description');
            $cus->doctor = $request->input('doctor');
            // Gets the currently logged in user and saves their ID as the posts ID
            $cus->user_id = auth()->user()->id;
            $cus->save();

            // redirect the customer, we have made a successful request to the DB back to the cus page
            return redirect('/admin')->with('success', 'Appointment Made');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        } else {
            return redirect('/')->with('error', 'Unauthorized account');
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        // check for correct user 

        // if(auth()->user()->id !== $customer->user_id){
        //     return redirect ('/appointments')->with('error', 'Unauthorized Page');
        // }
        return view('customers.edit')->with('customer', $customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
                // Validate the request
                $this->validate($request, 
                ['name' => 'required',
                'description' => 'required',
                'doctor' => 'required']);
    
                // find the customer with the matching id 
                $cus = Customer::find($id);
                $cus->name = $request->input('name');
                $cus->description = $request->input('description');
                $cus->doctor = $request->input('doctor');
                $cus->save();
    
                // redirect the customer, we have made a successful request to the DB back to the cus page
                return redirect('/admin')->with('success', 'Appointment Modified');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find the post 
        $cust = Customer::find($id);
        // Delete the post 
        $cust->delete();
        // Redirect back to post's page 
        return redirect('/admin')->with('success', 'Appointment Deleted');

    }
}
