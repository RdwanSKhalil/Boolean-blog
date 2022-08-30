<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\comment;
use App\Models\reply;
use Auth;

class PostController extends Controller
{
    public function create(){
        return view('posts.create');
    }
    
    public function store(Request $request){

        $validated = $request->validate([
            'title' => 'required|max:255',
            'text' => 'required',
            'imgPath' => 'required',
        ]);

        $post = new post();

        $post->title = request('title');
        $post->text = request('text');
        $file= $request->file('imgPath');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('images'), $filename);
        $post->img_path = "images/".$filename;
        $post->author = Auth::user()->name;
        $post->user_id = Auth::user()->id;
        $post->save();
        
        return redirect('/');
    }

    public function show($id){

        $post = post::findOrFail($id);

        $comments = comment::join("users", "users.id", "=", "comments.commenter_id")->select(
        'comments.id',
        'comments.comment',
        'comments.post_id',
        'comments.created_at',
        'comments.commenter_id',
        'users.name')->get();

        $replies = reply::join("users", "users.id", "=", "replies.user_id")->select(
        'replies.id',
        'replies.user_id',
        'replies.reply',
        'replies.created_at',
        'users.name',
        'replies.comment_id')->get();
            
        return view('posts.show', ['post' => $post, 'comments' => $comments, 'replies' => $replies]);

    }

    public function destroy($id){

        $post = post::findOrFail($id);

        $post->delete();

        return redirect('/');
    }
}
