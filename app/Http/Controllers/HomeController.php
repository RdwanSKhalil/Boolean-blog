<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();

        return view('home', ['posts' => $posts]);
    }
}
