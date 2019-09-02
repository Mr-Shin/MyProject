@extends('layouts.app')

@section('content')
    {{--@include('includes.tinyMCE')--}}
    <div class="text-center mb-3">
        <a class="btn btn-lg btn-info" style="width: 50%" href="{{route('books.index')}}">Back to list</a>
    </div>
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
                    <input id="summary" type="hidden" name="summary" value="{{old('summary')}}">
                    <trix-editor input="summary"></trix-editor>
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
                            <option value="{{$category->id}}" {{ (collect(old('category_id'))->contains($category->id)) ? 'selected' : '' }}>{{$category->name}}</option>
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
                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name">
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
        $('#category').select2();
    </script>
@endsection