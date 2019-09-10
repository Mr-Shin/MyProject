@extends('layouts.admin')

@section('content')
            <div class="card">
                <div class="card-header text-center">Hello {{auth()->user()->name}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2 class="text-center font-italic">

                        This is your dashboard...
                    </h2>


                </div>

            </div>
@endsection