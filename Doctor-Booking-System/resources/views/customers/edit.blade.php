@extends('layouts.app')


@section('content')
    
<h1>Edit Appointment</h1>
{!! Form::open(['action' => ['AppointmentController@update', $customer->id], 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', $customer->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}    
    </div>    

    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{Form::textarea('description', $customer->description, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Description'])}}    
    </div> 

    <div class="form-group">
         {{Form::label('doctor', 'Doctor')}}
         {{Form::text('doctor', $customer->doctor, ['class' => 'form-control', 'placeholder' => 'Doctor Name'])}}    
    </div> 
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}


{!! Form::close() !!}

@endsection