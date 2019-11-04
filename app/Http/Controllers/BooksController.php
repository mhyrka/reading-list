<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\books;
use App\MyBooks;
use Dotenv\Regex\Success;

class BooksController extends Controller
{
    public function getBooks()
    {
        $books = DB::table('books')->select('id', 'title', 'author_first', 'author_last', 'publisher', 'isbn')->get();
        // $books = books::all();

        // return json_encode($books, JSON_PRETTY_PRINT);
        $book_ids = DB::table('my_books')
            ->select('book_id')
            ->pluck('book_id')
            ->toArray();
        $my_books = DB::table('books')
            ->select('id', 'title', 'author_first', 'author_last', 'publisher', 'isbn')
            ->distinct()
            ->whereIn('id', $book_ids)
            ->get();
        return view('books')->with(['books' => $books, 'my_books' => $my_books]);
        // return $my_books;
    }

    public function addBook(Request $request)
    {
        $my_book = MyBooks::create(['book_id' => "$request->id"]);
        $book_ids = DB::table('my_books')
            ->select('book_id')
            ->pluck('book_id')
            ->toArray();
        $this->getBooks();
        return response($my_book, 200);
    }

    public function removeBook(Request $request)
    {
        DB::table('my_books')
            ->select()
            ->where('book_id', '=', $request->id)
            ->delete();
        // $book->delete();
        $this->getBooks();
        // return $request->id;
    }
}
