@extends('layouts.app')

@section('content')
{{--@include('includes.tinyMCE')--}}
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('books.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                           id="name" placeholder="Book's name"
                           value="{{old('name')}}">

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" class="form-control{{ $errors->has('author') ? ' is-invalid' : '' }}"
                           name="author" id="author" placeholder="Author's name"
                           value="{{old('author')}}">
                    @if ($errors->has('author'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('author') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group shadow-textarea">
                    <label for="summary">Summary:</label>
                    <textarea class="form-control z-depth-1" name="summary" id="summary" rows="5"
                              placeholder="Write something here...">{{old('summary')}}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control-file{{ $errors->has('image') ? ' is-invalid' : '' }}"
                           name="image" id="image">
                    @if ($errors->has('image'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image')}}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select name="category_id[]" id="category" class="form-control" multiple>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach

                    </select>

                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-block btn-success">Save</button>
                </div>
            </form>
            <br>


            <form method="POST" action="{{route('category.store')}}">
                @csrf
                <div class="form-group">
                    <label for="name">
                        Add Category:
                    </label>
                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" >
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name')}}</strong>
                                    </span>
                    @endif
                    <button type="submit" class="btn btn-block btn-primary mt-3">Add</button>
                </div>
            </form>


        </div>


    </div>

@endsection