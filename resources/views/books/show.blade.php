@extends('layouts.app')

@section('content')

    @include('includes.tinyMCE')
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
            <img class="rounded" style="width: 300px;height:300px" src='/storage/images/{{$book->image}}'>
        </div>
        <h1 class="card-header text-center mt-3">{{$book->name}}</h1>
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
                <label for="text">Comment:</label>
                <textarea class="form-control" name="text"
                          id="text" placeholder="Enter your comment..." rows="5"
                >
            </textarea>
                <div class="text-center">
                    <button type="submit" class="btn btn-block btn-primary">Comment</button>
                </div>
            </div>


        </form>
    @endif

    @foreach($comments as $comment)

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="card-img col-sm-2">
                        <img height="100px" src="/storage/images/{{$comment->photo}}" alt="">

                    </div>
                    <div class="col-sm-10">

                        <p class="font-weight-bold font-italic">{!! $comment->author!!}
                            <small><i> {!! $comment->created_at->diffForHumans()!!}</i></small>
                        </p>
                        <p class="text-right"></p>

                        <blockquote class="blockquote mb-0 text-justify">
                            {!! $comment->text !!}
                        </blockquote>
                    </div>
                </div>
                {{--<div class="row" style="text-align: right;--}}
    {{--position: absolute;--}}
    {{--right: 20px;--}}
    {{--bottom: 10px;--}}
{{--">--}}
                    {{--<button class="btn dropdown-toggle font-weight-bold font-italic showReplies"--}}
                       {{--href="#" role="button">Replies</button>--}}
                {{--</div>--}}
            </div>


        </div>
        @foreach($comment->replies as $reply)

            <div class="card replies" style="left: 100px;margin-top: 10px">
                <div class="card-body" id="replies">
                    <div class="row">
                        <div class="card-img col-sm-2">
                            <img height="100px" src="/storage/images/{{$reply->photo}}" alt="">

                        </div>
                        <div class="card-title col-sm-10">

                            <p class="font-weight-bold font-italic">{!! $reply->author!!}
                                <small><i> {!! $reply->created_at->diffForHumans()!!}</i></small>
                            </p>
                            <p class="text-right"></p>

                            <blockquote class="blockquote mb-0 text-justify">
                                {!! $reply->text !!}
                            </blockquote>
                        </div>
                    </div>
                </div>


            </div>
        @endforeach
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

@endsection


{{--@section('scripts')--}}
{{--<script>--}}

    {{--$(document).ready(function () {--}}

{{--$('div>button.showReplies').click(function () {--}}

    {{--$('.re').next().toggle('slow');--}}

{{--});--}}
    {{--});--}}

{{--</script>--}}



