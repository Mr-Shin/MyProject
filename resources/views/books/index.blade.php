@extends('layouts.app')

@section('content')

    @if($books->isEmpty())
        <h5 class="text-center font-italic">We don't have any books yet! Add one :) </h5>
    @else
        <table class="table">

            <tr>
                <th>
                    Book's name
                </th>
                <th>
                    Author
                </th>
                <th></th>
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
                    @can('update',$book)
                        <td>
                            <a class="btn btn-success" href={{route('books.edit',['id'=>$book->id])}}>Update</a>
                        </td>
                    @else
                        <td></td>
                    @endcan
                </tr>
            @endforeach
        </table>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <a href="{{route('books.create')}}" class="btn btn-primary btn-block">Add</a>
        </div>
    </div>
@endsection

