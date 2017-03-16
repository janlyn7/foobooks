<?php

namespace Foobooks\Http\Controllers;

use Illuminate\Http\Request;
use App;

class BookController extends Controller
{
    /**
    * GET /books
    */
    public function index() {
    	return App::environment();
        //return 'Here are all the books...';
    }

    /**
    * GET
    * /books/{title?}
    */
    public function show($title) {
        return view('books.show')->with(['title' => $title]);
    }

}
