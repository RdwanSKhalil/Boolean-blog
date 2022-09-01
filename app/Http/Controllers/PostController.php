<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\comment;
use App\Models\reply;
use Auth, File, DB;

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

        if(File::exists($post->img_path) == false){
            $post->img_path = "images/placeholder-img.webp"; 
        }

        $author = DB::table('users')->where('id', '=', $post->user_id)->first();

        $comments = comment::join("users", "users.id", "=", "comments.commenter_id")
        ->where('post_id', '=', $id)->select(
        'comments.id',
        'comments.comment',
        'comments.post_id',
        'comments.created_at',
        'comments.commenter_id',
        'users.name',
        'users.img_path')->get();

        $replies = reply::join("users", "users.id", "=", "replies.user_id")->select(
        'replies.id',
        'replies.user_id',
        'replies.reply',
        'replies.created_at',
        'users.name',
        'replies.comment_id',
        'replies.reply_id',
        'users.img_path')->get();
            
        return view('posts.show', ['post' => $post, 'comments' => $comments, 'replies' => $replies, 'author' => $author]);

    }

    public function destroy($id){

        $post = post::findOrFail($id);

        $post->delete();

        return redirect('/');
    }
}
