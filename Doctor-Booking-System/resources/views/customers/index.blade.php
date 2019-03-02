@extends('layouts.app')


@section('content')
    
<h1>My Appointments</h1>
    {{-- @if (Auth::user()->id == $customer->user_id) --}}
        @if (count($customer) > 0)

            @foreach ($customer as $customerData)
                <div class="well">
                    <h3><a href="/appointments/{{$customerData->id}}">{{$customerData->name}}</a></h3>
                <small>Written on {{$customerData->created_at}} by {{$customerData->user->name}}</small>
                </div>
            @endforeach

            {{$customer->links()}}

        @else
            <p>No Appointments Found!</p>
            
        @endif
    {{-- @endif --}}

@endsection