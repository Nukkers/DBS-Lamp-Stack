@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/appointments/create" class="btn btn-primary">Make An Appointment</a>
                    <h3>Your Appointments</h3>
                    @if (count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Doctor's Name</th>
                            </tr>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{$post->name}}</td>
                                    <td><a href="/appointments/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                                    <td>{{$post->doctor}}</td>
                                    <td>
                                        {!!Form::open(['action' => ['AppointmentController@destroy', $post->id],
                                        'method' => 'POST', 'class' => 'pull-right'])!!}
                                    
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close() !!}

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You Have No Appointments!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
