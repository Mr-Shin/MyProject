<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Comment;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\New_;

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }


    public function show($id)
    {
        $book = Book::findOrFail($id);
        $comments=$book->comments()->paginate(2);
        return view('books.show', compact('book','comments'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'summary' => 'nullable',
            'image' => 'required',


        ]);

        $sample = $request->except('_token');

        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $filenameToStore = $filename . '_' . time() . '.' . $extension;
        $path = $request->file('image')->storeAs('public/images', $filenameToStore);
        $sample['image'] = $filenameToStore;

        $book = Auth::user()->books()->create($sample);
        $book->categories()->attach($request->get('category_id'));

        return redirect(route('books.index'))->with('success', 'The book was added successfully.');
    }

    public function edit($id)
    {
        $book = Book::find($id);
        $categories = Category::all();
        $this->authorize('update', $book);

        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if ($request->hasFile('image')) {
            File::delete('storage/images/' . $book->image);
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/images', $filenameToStore);
            $book['image'] = $filenameToStore;

        }


        $book->update($request->only(['name', 'author', 'summary']));
        $book->categories()->sync($request->get('category_id'));
        return redirect(route('books.show', ['id' => $book->id]))->with('success', 'The book was updated successfully.');
    }

    public function delete($id)
    {
        $book = Book::find($id);
        File::delete('storage/images/' . $book->image);
        $book->delete();

        return redirect(route('books.index'))->with('success', 'The book was deleted successfully.');

    }

    public function newCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories'
        ]);
        Category::create([
                'name' => $request->name
            ]
        );
        return redirect(route('books.create'));

    }

    public function newComment(Request $request,$id)
    {
        Comment::create([
                'author' => Auth::user()->name,
                'photo'=>Auth::user()->photo,
                'text' => $request->text,
                'book_id'=>$id
            ]
        );
        return redirect(route('books.show',  ['id' =>$id]));

    }

    public function newReply(Request $request)
    {
//        dd($request->toArray());
        Reply::create([
                'author' => Auth::user()->name,
                'photo'=>Auth::user()->photo,
                'text' => $request->text,
                'comment_id'=>$request->comment_id
            ]
        );
        return redirect()->back();

    }
}
