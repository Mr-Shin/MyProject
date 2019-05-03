@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">Hello!</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <h2 class="text-center font-italic">

                            Welcome to our website!
                        </h2>


                </div>

            </div>


            <a href="{{route('books.index')}}" class="mt-4 text-center btn btn-lg btn-block btn-success">

                Book list
            </a>
        </div>
    </div>
@endsection
