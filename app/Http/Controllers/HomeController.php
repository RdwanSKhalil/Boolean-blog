<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = post::all();
        
        return view('home', ['posts' => $posts]);
    }
}
