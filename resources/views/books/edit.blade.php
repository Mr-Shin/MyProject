@extends('layouts.app')

@section('content')
    {{--@include('includes.tinyMCE')--}}
    <div class="text-center mb-3">
        <a class="btn btn-lg btn-info" style="width: 50%" href="{{route('books.show',['id'=>$book->id])}}">Back to the
            book</a>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('books.update',['id'=>$book->id])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Book's name"
                           value="{{$book->name}}">
                </div>
                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" class="form-control" name="author" id="author" placeholder="Author's name"
                           value="{{$book->author}}">
                </div>

                <div class="form-group shadow-textarea">
                    <label for="summary">Summary:</label>
                    <input id="summary" type="hidden" name="summary" value="{{$book->summary}}">
                    <trix-editor input="summary"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select name="category_id[]" id="category" class="form-control" multiple>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{$book->categories->contains('id',$category->id)?'selected':''}}>
                                {{$category->name}}
                            </option>
                        @endforeach


                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control-file" name="image" id="image">
                </div>
                <div class="text-center">
                    <img id="img" class="img-thumbnail" style="width: 200px;height:200px"
                         src='/storage/images/{{$book->image}}'>
                </div>

                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-success btn-block">Update</button>
                </div>
            </form>
            <div class="form-group text-center mt-1">
                <button id="delete" type="submit" class="btn btn-block btn-danger" data-toggle="modal"
                        data-target="#deleteModal">Delete
                </button>
            </div>
        </div>

    </div>
    <form action="{{route('books.delete',['id'=>$book->id])}}" method="POST">
        @method('DELETE')
        @csrf
        <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title">Delete Book</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-white">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="font-weight-bold text-lg-center">Are you sure you want to delete this book?!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Go back.</button>
                        <button type="submit" class="btn btn-danger">Yeah,Go ahead</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

@endsection
@section('readyscript')
    <script>
        $(document).ready(function () {
            $('#category').select2();

            function deleteModal() {
                $("#deleteModal").modal('show');
            };
            $("#image").change(function () {
                var input = this;
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#img").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            })
        });
    </script>
@endsection