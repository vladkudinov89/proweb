@extends('layouts.app')

@section('content')
    <div class="container">

    <form class="form-horizontal" action="{{route('profile.update' , $user)}}" method="post">
        <input type="hidden" name="_method" value="put">
        {{csrf_field()}}

        {{--Form include--}}
        @include('profile.partials.form')


    </form>

    </div>
@endsection
