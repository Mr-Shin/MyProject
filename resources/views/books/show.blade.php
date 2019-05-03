@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <a class="btn btn-block btn-info" href={{route('books.index')}}>Back to list</a>
        </div>
        <div class="col-sm-6">
            <a class="btn btn-block btn-success" href={{route('books.edit',['id'=>$book->id])}}>Update</a>
        </div>
    </div>






    <div class="card mt-5">
        <div class="text-center card-img">
            <img style="width: 300px;height:300px" src='/storage/images/{{$book->image}}'>
        </div>
        <h1 class="card-header text-center mt-3">{{$book->name}}</h1>
        <h4 class="text-center card-title">{{$book->author}}</h4>
        <div class="card-body">
            <blockquote class="blockquote mb-0 text-justify">{{$book->summary}}</blockquote>
        </div>
        <div class="card-footer">
            <p class="font-italic text-center text-info">
                @foreach($book->categories as $category)

                    <em class="col-sm-4">{{$category->name}}</em>
                @endforeach
            </p>

        </div>
        </div>
    <br>
    <br>
@endsection