<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);
        Reply::create([
                'author' => Auth::user()->name,
                'photo' => Auth::user()->photo,
                'text' => $request->text,
                'comment_id' => $request->comment_id,
                'user_id' => Auth::user()->id,

            ]
        );
        return redirect()->back();

    }

    public function destroy($id, Reply $reply)
    {
        $reply->delete();
        return redirect(route('books.show', ['id' => $id]))->with('success', 'The reply was deleted successfully.');

    }
}
