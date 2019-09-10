@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('profile.update',['user'=>\Illuminate\Support\Str::slug($user->name)])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="User's name"
                           value="{{$user->name}}">
                    @if ($errors->has('name'))
                        <span class="-danger" role="alert">
                                        <strong>{{$errors->first('name')}}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group shadow-textarea">
                    <label for="about">About:</label>
                    <input id="about" type="text" class="form-control" name="about" placeholder="About user" value="{{$user->about}}">
                </div>
              <div class="form-group">
                    <label for="image">Photo:</label>
                    <input type="file" class="form-control-file" name="photo" id="image">
                </div>
                <div class="text-center">
                    <img id="img" class="img-thumbnail" style="width: 200px;height:200px"
                         src='/storage/images/{{$user->photo}}'>
                </div>

                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-success btn-block">Update</button>
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