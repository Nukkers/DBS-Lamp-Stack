@extends('layouts.app')


@section('content')
    
<h1>Admin Page</h1>
    
     @if (count($posts) > 0)
        @foreach ($posts as $customerData)
            <div class="well">
                <h3><a href="/appointments/{{$customerData->id}}">{{$customerData->name}}</a></h3>
            <small>Written on {{$customerData->created_at}} by {{$customerData->user->name}}</small>
            </div>
            <!-- Renders the page links to the screen when we have more than 10 posts per page -->
            {!! $posts->links() !!}
        @endforeach
    @else
        <p>No Appointments Found!</p>
    @endif

    <a href="/admin/create" class="btn btn-primary">Make An Appointment</a>
        

@endsection