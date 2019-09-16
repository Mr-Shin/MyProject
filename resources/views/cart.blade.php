@extends('layouts.app')
@section('content')
    <table class="table table-striped table-responsive-md index">
        <tr>
            <th width="40%">Product(s)</th>
            <th>Price(each)</th>
            <th>Quantity</th>
        </tr>
        @foreach($items as $item)

            <tr>
                <td class="col-sm-8 col-md-6">
                    <div class="media">
                        <img class="img-thumbnail mr-2" src="/storage/images/{{$item->model->image}}"
                             style="width: 72px; height: 72px;">
                        <div class="media-body mr-sm-0 mr-4">
                            <h4><a href="{{route('books.show',['id'=>$item->id])}}">{{$item->name}}</a>
                            </h4>
                            <h5>by {{$item->model->author}}</h5>
                        </div>
                    </div>
                </td>
                <td>
                    ${{$item->price}}
                </td>
                <td>
                    {{$item->qty}}
                </td>
                <td>
                    <form action="{{route('cart.remove',['id'=>$item->rowId])}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i> Remove</button>

                    </form>
                </td>
            </tr>
        @endforeach
        <tr>
            <td><a href="{{route('books.index')}}" class="btn btn-info"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
            <td colspan="2" class="hidden-xs"><strong>Total: ${{Cart::subtotal()}}
                </strong></td>
            <td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
        </tr>
    </table>

@endsection
