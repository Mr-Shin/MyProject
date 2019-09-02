@extends('layouts.app')

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
                <th>
                    <a href="{{route('books.create')}}" class="btn btn-primary">Add</a>
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
                    @can('update',$book)
                        <td>
                            <a class="btn btn-success" href={{route('books.edit',['id'=>$book->id])}}>Edit</a>
                        </td>
                    @else
                        <td></td>
                    @endcan
                </tr>
            @endforeach
        </table>
    @endif

    <div class="row">
        <div class="col-12">
            {{$books->appends(['search'=>request()->query('search')])->links()}}
        </div>

    </div>


@endsection

