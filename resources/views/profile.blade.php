@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">


                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card mb-3" style="width: 18rem;">
                    <div class="card-header">Your Profile</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$current_user->name}}</h5>
                        <p class="card-text">{{$current_user->about}}</p>
                        <a href="{{route('profile.edit' , $current_user)}}" class="btn btn-info">Edit Profile</a>
                    </div>
                </div>


                <div class="card-columns">
                    @forelse($users as $user)
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{$user->name}}</h5>
                                <p class="card-text">{{$user->about}}</p>
                                <a href="{{route('profile.show' , $user)}}" class="card-link">View</a>

                                @can('update', $user)

                                    <a href="{{route('profile.edit' , $user)}}">Edit</a>

                                    <form action="{{ route('profile.destroy',$user) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class="btn btn-danger" type="submit">
                                            Delete
                                        </button>
                                    </form>

                                @endcan
                            </div>
                        </div>
                    @empty
                        <p>No users</p>
                    @endforelse

                </div>
            </div>
        </div>
@endsection
