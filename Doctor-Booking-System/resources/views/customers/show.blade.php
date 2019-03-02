@extends('layouts.app')


@section('content')
    <a href="/appointments" class="btn btn-default">Go Back</a>
    <h1>{{$customer->name}}</h1>
    <div>
        {!!$customer->description!!}
    </div>
    <hr>
    <small>Written on {{$customer->created_at}} by {{$customer->user->name}}</small>

    <hr>
    @if (Auth::user()->id == $customer->user_id)
        <a href="/appointments/{{$customer->id}}/edit" class="btn btn-default">Edit</a>
        
        {!!Form::open(['action' => ['AppointmentController@destroy', $customer->id],
        'method' => 'POST', 'class' => 'pull-right'])!!}

            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close() !!}
     @endif

@endsection