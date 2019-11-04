<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\books;
use App\MyBooks;

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
        MyBooks::create(['book_id' => "$request->id"]);
        $book_ids = DB::table('my_books')
            ->select('book_id')
            ->pluck('book_id')
            ->toArray();
        $my_books = DB::table('books')
            ->select('id', 'title', 'author_first', 'author_last', 'publisher', 'isbn')
            ->whereIn('id', $book_ids)
            ->get();

        // // return json_encode($my_books, JSON_PRETTY_PRINT);
        // return view('readinglist')->with('my_books', $my_books);
        // return $book_ids;
        return $this->getBooks();
    }
}
