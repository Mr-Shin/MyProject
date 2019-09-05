@extends('layouts.app')

@section('content')

    {{--@include('includes.tinyMCE')--}}
    <div class="row">
        <div class="col-sm-6">
            <a class="btn btn-block btn-info" href={{route('books.index')}}>Back to list</a>
        </div>
        @can('update',$book)
            <div class="col-sm-6">
                <a class="btn btn-block btn-success" href={{route('books.edit',['id'=>$book->id])}}>Edit</a>
            </div>
        @else
            <div class="col-sm-6">
                <button type="button" class="btn btn-block btn-success" data-toggle="tooltip" data-placement="bottom"
                        title="Only {{$book->user->name}} can edit this book." disabled>Edit
                </button>
            </div>
        @endcan

    </div>






    <div class="card mt-3">
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

                    <a href="{{route('category.show',['id'=>$category->id])}}"><em
                                class="col-sm-4">{{$category->name}}</em></a>
                @endforeach
            </p>

        </div>
    </div>
    <br>
    <br>

    <div class="jumbotron">

        @auth

            <form action="{{route('comment.store',['id'=>$book->id])}}" method="POST">
                @csrf

                @if ($errors->has('comment'))
                    <div class="text-center">
                    <span class="badge-danger">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                    </div>
                @endif
                <div class="row">
                    <div class="col-2 text-right">
                        <img src="/storage/images/{{\Illuminate\Support\Facades\Auth::user()->photo}}" height="100px"
                             alt="...">

                    </div>
                    <div class="col-10">
                        <div class="form-group">
                <textarea class="form-control" name="comment"
                          id="comment" placeholder="Leave a message..." rows="3"
                ></textarea>
                            <div class="text-center mt-1">
                                <button id="myBtn" type="submit" class="btn btn-block btn-primary"
                                        style="display: none">Comment
                                </button>
                            </div>
                        </div>

                    </div>
                </div>


            </form>
            <hr>
            @else
            <div class="justify-content-center row">
            <a href="{{route('login')}}" style="width: 50%" class="btn btn-primary btn-block">Sign in to leave a comment.</a>
            </div>
        @endauth

        <ul class="list-group">
            @if ($errors->has('text'))
                <div class="text-center">
                    <span class="badge-danger">
                                        <strong>{{ $errors->first('text') }}</strong>
                                    </span>
                </div>
            @endif
            @foreach($comments as $comment)

                <li class="media text-white comment mb-2">
                    <img src="/storage/images/{{$comment->photo}}" class="mr-3 ml-2 mt-3 rounded-circle" height="100px"
                         alt="...">
                    <div class="media-body mt-3">
                        <div class="row">
                            <p class="col-7 font-weight-bold font-italic">{!! $comment->author!!}

                            </p>
                            <p class="col-4 ml-5 text-right font-italic">{!! $comment->created_at->diffForHumans()!!}</p>
                        </div>
                        <blockquote class="blockquote mb-0 text-justify">
                            {!! $comment->comment !!}
                        </blockquote>
                        @auth
                            <a class="dropdown-toggle"
                               href="" role="button" data-toggle="collapse" data-target="#form{{$comment->id}}"
                               aria-expanded="false"
                               v-pre>Reply</a>
                            @if(auth()->user()->id == $comment->user_id)
                                <a href="#deleteModal" role="button"
                                   onclick="deleteComment({{$comment->id}},{{$book->id}})"
                                   id="delete"
                                   class="ml-2 text-danger">Delete
                                </a>
                            @endif

                            <form id="form{{$comment->id}}" class="mt-2 collapse" action="{{route('reply.store')}}"
                                  method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                    <input class="form-control" name="text"
                                           id="text" placeholder="Leave a message and press 'Enter'"
                                    >
                                </div>
                                <div class="form-group text-center">
                                    <input type="submit" class="d-none">
                                </div>

                            </form>
                        @endauth


                        <ul>
                            @foreach($comment->replies as $reply)
                                <li class="media mt-4 mb-2">
                                    <img src="/storage/images/{{$reply->photo}}" class="mr-3 rounded-circle"
                                         height="100px" alt="...">
                                    <div class="media-body">
                                        <div class="row">
                                            <p class="col-7 font-weight-bold font-italic">{!! $reply->author!!}
                                            </p>
                                            <p class="col-4 text-right font-italic">{!! $reply->created_at->diffForHumans()!!}</p>
                                        </div>
                                        <blockquote
                                                class="blockquote mb-0 text-justify">{!! $reply->text !!}</blockquote>
                                        @if(auth()->user()->id == $reply->user_id)
                                            <p class="text-right mr-5">
                                            <a href="#deleteModal" role="button"
                                               onclick="deleteReply({{$reply->id}},{{$book->id}})"
                                               id="deleteReply"
                                               class="text-danger">Delete
                                            </a>
                                            </p>
                                        @endif

                                    </div>
                                </li>
                            @endforeach

                        </ul>

                    </div>

                </li>


            @endforeach
        </ul>
    </div>




    <div class="row">
        <div class="col-sm-12">
            {{$comments->links()}}
        </div>
    </div>

    <form id="form" action="" method="POST">
        @method('DELETE')
        @csrf
        <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title">Delete Comment</h5>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true" class="text-white">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="font-weight-bold text-lg-center text-dark">Are you sure you
                            want to delete this comment?!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            No,Go back.
                        </button>
                        <button type="submit" class="btn btn-danger">Yeah,Go ahead</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <script>
        function deleteComment(comment, id) {
            var form = document.getElementById('form');
            form.action = '/books/' + id + '/' + comment;
            $("#deleteModal").modal('show');
        }
        function deleteReply(reply, id) {
            var form = document.getElementById('form');
            form.action =` /books/${id}/comments/replies/${reply}`;
            $("#deleteModal").modal('show');
        }

        $('[data-toggle="tooltip"]').tooltip();
        $("#comment").keyup(function () {
            $value = $("#comment").val();
            if ($value) {
                $("#myBtn").fadeIn();
            } else {
                $("#myBtn").fadeOut();

            }
        });
    </script>
@endsection





