@extends('layouts.app')


@section('content')
    
<h1>Create Appointment</h1>
{!! Form::open(['action' => 'AppointmentController@store', 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}    
    </div>    

    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Description'])}}    
    </div> 

    <div class="form-group">
         {{Form::label('doctor', 'Doctor')}}
         {{Form::text('doctor', '', ['class' => 'form-control', 'placeholder' => 'Doctor Name'])}}    
    </div> 

    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}



{!! Form::close() !!}

@endsection