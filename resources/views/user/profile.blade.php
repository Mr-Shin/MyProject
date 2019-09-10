@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Profile
        </div>
        <div class="row no-gutters">
            <div class="col-3 my-4 ml-2">
                <img class="card-img" src="/storage/images/{{$user->photo}}" alt="">
            </div>

            <div class="col-8">
                <div class="card-body">
                    <h1 class="card-title">
                        {{$user->name}}
                        <span class="badge badge-secondary float-right">
                            @if($user->is_admin)
                                Admin
                            @else
                                User
                            @endif</span>
                    </h1>

                    <blockquote class="blockquote">
                        <p>
                            {!! $user->about !!}</p>
                    </blockquote>
                    <div class="row my-3" style="position:absolute;bottom:0;width: 100%">
                        <div class="col-4">
                            <a href="{{route('profile.edit',['user'=>\Illuminate\Support\Str::slug($user->name)])}}" class="btn btn-primary btn-block">Edit Profile</a>
                        </div>
                        @if($user->is_admin)
                        <div class="col-8">
                        <a href="{{route('dashboard')}}" class="btn btn-primary btn-block">Dashboard</a>
                        </div>
                            @endif
                        </div>
                 </div>

            </div>

            </div>
        </div>


@endsection