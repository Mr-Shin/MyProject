@extends('layouts.app')

@section('content')

    {{--@include('includes.tinyMCE')--}}
    <div class="row">
        <div class="col-sm-6">
            <a class="btn btn-block btn-info" href={{route('books.index')}}>Back to list</a>
        </div>
        <div class="col-sm-6">
            <a class="btn btn-block btn-success" href={{route('books.edit',['id'=>$book->id])}}>Update</a>
        </div>
    </div>






    <div class="card mt-5">
        <div class="text-center mt-3">
            <img class="rounded" style="width: 300px;height:300px" src='/storage/images/{{$book->image}}'>
        </div>
        <h1 style="background-color: #1b1e21;color:white" class="text-center mt-3">{{$book->name}}</h1>
        <h4 class="text-center card-title">{{$book->author}}</h4>
        <div class="card-body">
            <blockquote class="blockquote mb-0 text-justify">{!! $book->summary !!}</blockquote>
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


    @if(\Illuminate\Support\Facades\Auth::check())


        <form action="{{route('comment.store',['id'=>$book->id])}}" method="POST">
            @csrf
            <div class="form-group">
                <textarea class="form-control" name="text"
                          id="text" placeholder="Leave a message..." rows="5"
                >
            </textarea>
                <div class="text-center mt-1">
                    <button type="submit" class="btn btn-block btn-primary">Comment</button>
                </div>
            </div>


        </form>
    @endif
    <ul class="list-group">
        @foreach($comments as $comment)
    <li class="media bg-white">
        <img src="/storage/images/{{$comment->photo}}" class="mr-3 ml-2 mt-3" height="100px" alt="...">
        <div class="media-body mt-3">
            <div class="row">
            <p class="col-7 font-weight-bold font-italic">{!! $comment->author!!}

            </p>
                <p class="col-4 ml-5 text-right font-italic text-secondary">{!! $comment->created_at->diffForHumans()!!}</p>
            </div>
            <blockquote class="blockquote mb-0 text-justify">
                {!! $comment->text !!}
            </blockquote>
            <ul>
            @foreach($comment->replies as $reply)
            <li class="media mt-4 mb-2">
                <img src="/storage/images/{{$reply->photo}}" class="mr-3" height="100px" alt="...">
                <div class="media-body">
                    <div class="row">
                    <p class="col-7 font-weight-bold font-italic">{!! $reply->author!!}
                    </p>
                        <p class="col-4 text-right font-italic text-secondary">{!! $reply->created_at->diffForHumans()!!}</p>
                    </div>
                    <blockquote class="blockquote mb-0 text-justify">
                        {!! $reply->text !!}
                    </blockquote>
                </div>
            </li>
            @endforeach

            </ul>
        </div>

    </li>
            @if(\Illuminate\Support\Facades\Auth::check())

                <form action="{{route('reply.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                        <label for="text">Reply:</label>
                        <input class="form-control" name="text"
                               id="text" placeholder="Enter your reply..."
                        >
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-block btn-success">Reply</button>
                    </div>

                </form>
            @endif

            <br>

        @endforeach
    </ul>
    {{--<br>--}}
    {{--<br>--}}
    {{--<br>--}}
    {{--@foreach($comments as $comment)--}}

        {{--<div class="card">--}}
            {{--<div class="card-body">--}}
                {{--<div class="row">--}}
                    {{--<div class="card-img col-sm-2">--}}
                        {{--<img height="100px" src="/storage/images/{{$comment->photo}}" alt="">--}}

                    {{--</div>--}}
                    {{--<div class="col-sm-10">--}}

                        {{--<p class="font-weight-bold font-italic">{!! $comment->author!!}--}}
                            {{--<small><i> {!! $comment->created_at->diffForHumans()!!}</i></small>--}}
                        {{--</p>--}}
                        {{--<p class="text-right"></p>--}}

                        {{--<blockquote class="blockquote mb-0 text-justify">--}}
                            {{--{!! $comment->text !!}--}}
                        {{--</blockquote>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>--}}


        {{--</div>--}}
        {{--@foreach($comment->replies as $reply)--}}

            {{--<div class="card replies" style="left: 100px;margin-top: 10px">--}}
                {{--<div class="card-body" id="replies">--}}
                    {{--<div class="row">--}}
                        {{--<div class="card-img col-sm-2">--}}
                            {{--<img height="100px" src="/storage/images/{{$reply->photo}}" alt="">--}}

                        {{--</div>--}}
                        {{--<div class="card-title col-sm-10">--}}

                            {{--<p class="font-weight-bold font-italic">{!! $reply->author!!}--}}
                                {{--<small><i> {!! $reply->created_at->diffForHumans()!!}</i></small>--}}
                            {{--</p>--}}
                            {{--<p class="text-right"></p>--}}

                            {{--<blockquote class="blockquote mb-0 text-justify">--}}
                                {{--{!! $reply->text !!}--}}
                            {{--</blockquote>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}


            {{--</div>--}}
        {{--@endforeach--}}
        {{--@if(\Illuminate\Support\Facades\Auth::check())--}}

            {{--<form action="{{route('reply.store')}}" method="POST">--}}
                {{--@csrf--}}
                {{--<div class="form-group">--}}
                    {{--<input type="hidden" name="comment_id" value="{{$comment->id}}">--}}
                    {{--<label for="text">Reply:</label>--}}
                    {{--<input class="form-control" name="text"--}}
                           {{--id="text" placeholder="Enter your reply..."--}}
                    {{-->--}}
                {{--</div>--}}
                {{--<div class="form-group text-center">--}}
                    {{--<button type="submit" class="btn btn-block btn-success">Reply</button>--}}
                {{--</div>--}}

            {{--</form>--}}
        {{--@endif--}}

        {{--<br>--}}

    {{--@endforeach--}}
    <div class="row">
    <div class="col-sm-12" style="margin-left: 40%">
{{$comments->links()}}
    </div>
    </div>
@endsection



