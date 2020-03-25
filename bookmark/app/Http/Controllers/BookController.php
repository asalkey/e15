<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function edit($title=null)
    {
        dump($title);
       return view('books.edit');
    }
}
