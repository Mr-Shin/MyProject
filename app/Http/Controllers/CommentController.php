<?php

namespace App\Http\Controllers;

use App\Book;
use App\Comment;
use App\Notifications\NewCommentAdded;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request,$id)
    {
        $request->validate([
           'comment'=>'required',
        ]);
        $comment=Comment::create([
                'author' => Auth::user()->name,
                'user_id' => Auth::user()->id,
                'photo'=>Auth::user()->photo,
                'comment' => $request->comment,
                'book_id'=>$id,

            ]
        );
        $book=Book::find($id);
        if (Auth::user()->id!=$book->user_id) {
            $book->user->notify(new NewCommentAdded($comment));
        }
        return redirect(route('books.show',  ['id' =>$id]));

    }

    public function destroy($id,Comment $comment)
    {
        $comment->delete();
        return redirect(route('books.show',['id'=>$id]))->with('success', 'The comment was deleted successfully.');

    }

}
