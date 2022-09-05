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
        $file = $request->file('imgPath');
        $filename = date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('images'), $filename);
        $post->img_path = "images/".$filename;
        $post->author = Auth::user()->name;
        $post->user_id = Auth::user()->id;
        $post->save();
        
        return redirect('/')->with('success','Your post has been added');
    }

    public function show($id){

        $post = post::findOrFail($id);

        if(File::exists($post->img_path) == false){
            $post->img_path = "images/placeholder-img.webp"; 
        }

        return view('posts.show', ['post' => $post]);

    }

    public function editShow($id){
        
        $post = post::findOrFail($id);

        return view('posts.edit', ['post' => $post]);
    }

    public function edit(Request $request, $id){

        $validated = $request->validate([
            'title' => 'required|max:255',
            'text' => 'required',
            'imgPath' => 'image',
        ]);

        $post = post::findOrFail($id);

        $post->title = request('title');
        $post->text = request('text');
        if($request->hasFile('imgPath')){
            // add new photo
            $file = $request->file('imgPath');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $oldFileName = $post->img_path;
            // update the database
            $post->img_path = "images/".$filename;
            // delete the old photo
            File::delete(public_path($oldFileName));
        }
        $post->update();
        
        return redirect()->route('user.posts', Auth::id())->with('success','Your post has been edited');
    }

    public function destroy($id){

        $post = post::findOrFail($id);
        if($post->img_path != 'images/placeholder-img.webp'){
            File::delete(public_path($post->img_path));
        }
        $post->delete();

        return redirect()->route('user.posts', Auth::id())->with('deleted', 'You have deleted a post!');
    }
}
