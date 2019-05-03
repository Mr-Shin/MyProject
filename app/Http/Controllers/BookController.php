<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
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
        return view('books.show', compact('book'));
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

//        session()->flash('status','Created.');
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
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/images', $filenameToStore);
            $book['image'] = $filenameToStore;

        }


        $book->update($request->only(['name', 'author', 'summary']));
        $book->categories()->sync($request->get('category_id'));
        return redirect(route('books.update', ['id' => $book->id]))->with('success', 'The book was updated successfully.');
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

        Category::create([
                'name' => $request->name
            ]
        );
        return redirect(route('books.create'));

    }

}
