<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Bring in the model
use App\Customer;
use DB;

class AppointmentController extends Controller
{


     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // If you want the guest user to be able to view pages without logging in do this 
        // this will allow guest to view index page and show show.blade.php
        //$this->middleware('auth', ['except' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Fetch all the data inside this model
        //$customerData = Customer::all();

        // If you want to order the data, first param is what you want to order second is ascending descending  
        //$customerData = Customer::orderBy('name', 'desc')->get();

        // If you want to get the data based on a criteria 
        //return Customer::where('name', 'Steve Jobs')->get();

        // Get just one element of data 
        //$customerData = Customer::orderBy('name', 'desc')->take(1)->get();

        // If you want to simply use sql statements
        //$customerData = DB::select('SELECT * FROM customers');


        // Will allow one element of data per page, then adds a link at bottom of page to go
        // to next page for next piece of data, currently set to 10 pieces of data per page 
        // when we hit 11 it'll start a new page 
        $customerData = Customer::orderBy('created_at', 'desc')->paginate(10);


        // Load the view 
        return view('customers.index')->with('customer', $customerData);
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
            return redirect('/appointments')->with('success', 'Appointment Made');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Show the data we hold for the given id
        $customer = Customer::find($id);
        return view('customers.show')->with('customer', $customer);
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

        if(auth()->user()->id !== $customer->user_id){
            return redirect ('/appointments')->with('error', 'Unauthorized Page');
        }
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
                return redirect('/appointments')->with('success', 'Appointment Modified');
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
        return redirect('/dashboard')->with('success', 'Appointment Deleted');

    }
}
