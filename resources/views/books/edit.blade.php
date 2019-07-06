@extends('layouts.app')

@section('content')
{{--@include('includes.tinyMCE')--}}
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('books.update',['id'=>$book->id])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" id="name"  placeholder="Book's name" value="{{$book->name}}">
                </div>
                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" class="form-control" name="author" id="author" placeholder="Author's name" value="{{$book->author}}">
                </div>

                <div class="form-group shadow-textarea">
                    <label for="summary">Summary:</label>
                    <textarea class="form-control z-depth-1 " name="summary" id="summary" rows="5" placeholder="Write something here...">{{$book->summary}}</textarea>
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
                    <input type="file" class="form-control-sm" name="image" id="image">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-block">Update</button>
                </div>
            </form>
            <form method="POST" action="{{route('books.delete',['id'=>$book->id])}}" class="mt-3">
                @csrf
                @method('DELETE')
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-block btn-danger">Delete</button>
                </div>
            </form>
        </div>

    </div>



@endsection