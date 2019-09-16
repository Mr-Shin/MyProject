@extends('layouts.admin')

@section('content')
    @if(request()->query('search') and $books->isEmpty())
        <div class="index mb-1" style="padding: 20px">
            <h5 class="text-center font-italic"> No results found for "{{request()->query('search')}}" </h5>
        </div>

    @elseif($books->isEmpty())
        <div class="index mb-1" style="padding: 20px">
            <h5 class="text-center font-italic">We don't have any books yet! Add one :) </h5>
        </div>
        <div>
            <a href="{{route('books.create')}}" class="btn btn-primary btn-block">Add</a>
        </div>
    @else

        <table class="table table-striped index">

            <tr>
                <th>
                    Book's name
                </th>
                <th>
                    Author
                </th>
                <th colspan="2">
                    <a href="{{route('books.create')}}" class="btn btn-primary btn-block">Add New Book</a>
                </th>
            </tr>
            @foreach($books as $book)

                <tr>

                    <td>
                        <a href={{"/books/".$book->id}}>
                            <h5>{{$book->name}}</h5>
                        </a>
                    </td>
                    <td>

                        {{$book->author}}
                    </td>
                        <td>
                            <a class="btn btn-success" href={{route('books.edit',['id'=>$book->id])}}>Edit</a>
                        </td>
                    <td>
                        <button id="delete" type="submit" class="btn btn-danger" data-toggle="modal"
                                data-target="#deleteModal"
                                onclick="deletePost({{$book->id}})"
                        >Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

    <div class="row">
        <div class="col-12">
            {{$books->appends(['search'=>request()->query('search')])->links()}}
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

        </div>
        @endsection
@section('readyscript')
    <script>
        function deletePost(id) {
            var form = document.getElementById('form');
            form.action = ` /admin/posts/${id}`;
            $("#deleteModal").modal('show');
        };
    </script>


@endsection


