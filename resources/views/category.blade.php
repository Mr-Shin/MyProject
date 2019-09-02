@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header text-center font-weight-bold">
{{$category->name}}

        </div>
        <div class="card-body bg-dark">
        <div class="row">

        @foreach($books as $book)
                <a class="col-4" href="{{route('books.show',['id'=>$book->id])}}">
            <img class="img-thumbnail" src="/storage/images/{{$book->image}}" alt="">
            <p class="text-center text-white font-weight-bold">{{$book->name}}</p>
                </a>
@endforeach
        </div>
    </div>
    </div>
@endsection