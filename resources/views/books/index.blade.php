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
    @else
        {{--<table class="table table-striped index">--}}

        {{--<tr>--}}
        {{--<th>--}}
        {{--Book's name--}}
        {{--</th>--}}
        {{--<th>--}}
        {{--Author--}}
        {{--</th>--}}
        {{--<th>--}}
        {{--<a href="{{route('books.create')}}" class="btn btn-primary">Add</a>--}}
        {{--</th>--}}
        {{--</tr>--}}
        {{--@foreach($books as $book)--}}

        {{--<tr>--}}

        {{--<td>--}}
        {{--<a href={{"/books/".$book->id}}>--}}
        {{--<h5>{{$book->name}}</h5>--}}
        {{--</a>--}}
        {{--</td>--}}
        {{--<td>--}}

        {{--{{$book->author}}--}}
        {{--</td>--}}
        {{--@can('update',$book)--}}
        {{--<td>--}}
        {{--<a class="btn btn-success" href={{route('books.edit',['id'=>$book->id])}}>Edit</a>--}}
        {{--</td>--}}
        {{--@else--}}
        {{--<td></td>--}}
        {{--@endcan--}}
        {{--</tr>--}}
        {{--@endforeach--}}
        {{--</table>--}}
        <div class="row">
            @foreach($books as $book)
                <div class="col-12">
                    <div class="jumbotron bg-white">
                        <div class="row no-gutters">
                            <div class="col-3 my-4 ml-2">
                                <img style="max-height: 175px" class="card-img" src="/storage/images/{{$book->image}}"
                                     alt="">
                            </div>

                            <div class="col-8">
                                <div class="card-body">
                                    <a href={{"/books/".$book->id}}>
                                        <h1>
                                            {{$book->name}}

                                        </h1>
                                    </a>
                                    <blockquote class="blockquote">
                                        <p>{!! \Illuminate\Support\Str::limit($book->summary,100)!!}</p>

                                    </blockquote>
                                    <div class="row">
                                        <h3 class="col-md-6">${{$book->price}}</h3>
                                        <div class="col-md-6">
                                            <form action="{{route('cart.add')}}" method="POST">
                                                @csrf
                                                <input name="id" type="hidden" value="{{$book->id}}">
                                                <button type="submit" class="btn btn-primary float-right">
                                                    <i class="fas fa-cart-plus"></i>
                                                    Add to cart

                                                </button>
                                            </form>

                                        </div>


                                    </div>
                                </div>
                                {{--<p class="float-left">{{$book->price}}</p>--}}
                                {{--<a href="#" class="btn btn-primary float-right">Add to cart</a>--}}

                            </div>

                        </div>

                        {{--<img style="max-height:150px;width: 100%" src="/storage/images/{{$book->image}}"--}}
                        {{--class="img-thumbnail" alt="...">--}}
                        {{--<div>--}}
                        {{--<a href={{"/books/".$book->id}}>--}}
                        {{--<h5>{{$book->name}}</h5>--}}
                        {{--</a>--}}
                        {{--<p>{!! \Illuminate\Support\Str::limit($book->summary,50)!!}</p>--}}
                        {{--<a href="#" class="btn btn-primary">Go somewhere</a>--}}

                        {{--</div>--}}
                    </div>
                </div>
            @endforeach
        </div>

    @endif

    <div class="row">
        <div class="col-12">
            {{$books->appends(['search'=>request()->query('search')])->links()}}
        </div>

    </div>


@endsection

