<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
        * Create a new controller instance.
     *
     * @return void
        */
    public function __construct()
    {
        $this->middleware(['auth','verified'])->only(['profile','edit','update']);
        $this->middleware('admin')->only(['dashboard','notifications','posts']);
    }


    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $user = Auth::user();
        if ($request->hasFile('photo')) {
            File::delete('storage/images/' . $user->photo);
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('photo')->storeAs('public/images', $filenameToStore);
            $user['photo'] = $filenameToStore;

        }


        $user->update($request->only(['name', 'about']));
        return redirect(route('profile', ['user' =>Str::slug($user->name)]))->with('success', 'The book was updated successfully.');
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function posts()
    {

        $search=\request()->query('search');
        if ($search){
            $books=Book::where("name","LIKE","%{$search}%")->paginate(5);

        }
        else {
            $books = Book::paginate(5);
        }
        return view('user.posts', compact('books'));
    }

    public function delete($id)
    {
        $book = Book::find($id);
        File::delete('storage/images/' . $book->image);
        $book->delete();

        return redirect(route('posts'))->with('success', 'The book was deleted successfully.');
    }

    public function notifications()
    {
        Auth::user()->unreadNotifications->markAsRead();
        $notif=Auth::user()->notifications;
        return view('user.notifications',compact('notif'));
    }
}
