<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show($id){

        $user = User::findOrFail($id);

        $posts = $user->posts;

        $postsCount = $posts->count();

        $comments = $user->comments;

        $commentsCount = $comments->count();

        return view('users.show', ['user' => $user, 'postsCount' => $postsCount, 'commentsCount' => $commentsCount]);
    }

    public function posts($id){

        $user = User::findOrFail($id);

        $posts = $user->posts;

        $postsCount = $posts->count();

        $comments = $user->comments;

        $commentsCount = $comments->count();

        return view('users.posts', ['user' => $user, 'posts' => $posts, 'postsCount' => $postsCount, 'commentsCount' => $commentsCount]);
    }

    public function comments($id){

        $user = User::findOrFail($id);

        $posts = $user->posts;

        $postsCount = $posts->count();

        $comments = $user->comments;

        $commentsCount = $comments->count();

        return view('users.comments', ['user' => $user, 'comments' => $comments, 'posts' => $posts, 'postsCount' => $postsCount, 'commentsCount' => $commentsCount]);
    }
}
