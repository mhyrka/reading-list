<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\books;

class BooksController extends Controller
{
    public function getBooks()
    {
        // $books = DB::table('books')->get();
        $books = books::all();

        return json_encode($books, JSON_PRETTY_PRINT);
    }
}
