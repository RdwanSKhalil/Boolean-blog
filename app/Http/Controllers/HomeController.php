<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use DB;
use File;
class HomeController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')
        ->join("users", "users.id", "=", "posts.user_id")
        ->select(
            'posts.id',
            'posts.title',
            'posts.author',
            'posts.img_path',
            'posts.user_id',
            'posts.created_at',
            'posts.text',
            'users.img_path as user_img_path')->orderBy('created_at', 'desc')->get();

        foreach($posts as $post){
            if(File::exists($post->img_path) == false){
                $post->img_path = "images/placeholder-img.webp"; 
            }
        }
        
        return view('home', ['posts' => $posts]);
    }
}
