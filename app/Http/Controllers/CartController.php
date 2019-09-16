<?php

namespace App\Http\Controllers;

use App\Book;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items=Cart::content();
        return view('cart',compact('items'));
    }
    public function add(Request $request)
    {
        $book=Book::find($request->id);
        Cart::add($request->id, $book->name, 1 , $book->price)->associate('App\Book');

        return redirect('cart');
    }

    public function remove($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }
}
