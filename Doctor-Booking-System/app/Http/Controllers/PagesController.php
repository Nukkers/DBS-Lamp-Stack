<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome';
        return view('pages.index')->with('title', $title);
    }

    public function about(){
        $title =  'Welcome to the about page!';
        return view('pages.about')->with('title', $title);
    }

    public function services(){

        $data = array(
            'title' => 'Services',
            'services' => ['Book Appointment', 'Available Doctors']
        );

        //$title =  'Welcome to the services page!';
        return view('pages.services')->with($data);
    }

    
}
