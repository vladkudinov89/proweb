@extends('layouts.app')

@section('content')
    <div class="container">

        <h2 class="mb-4 mt-4">View "{{$user->name}}" profile</h2>

        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{$user->name}}</h5>
                <p class="card-text">{{$user->about}}</p>
                <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
            </div>
        </div>

    </div>
@endsection
