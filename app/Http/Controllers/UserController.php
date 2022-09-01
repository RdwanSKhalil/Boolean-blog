<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB, File, Hash;

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

        $posts = DB::table('posts')->orderBy('created_at', 'desc')->where('user_id', '=' ,$user->id)->get();

        foreach($posts as $post){
            if(File::exists($post->img_path) == false){
                $post->img_path = "images/placeholder-img.webp"; 
            }
        }

        $postsCount = $posts->count();

        $comments = $user->comments;

        $commentsCount = $comments->count();

        return view('users.posts', ['user' => $user, 'posts' => $posts, 'postsCount' => $postsCount, 'commentsCount' => $commentsCount]);
    }

    public function comments($id){

        $user = User::findOrFail($id);

        $postsCount = $user->posts->count();

        $comments = DB::table('comments')->orderBy('created_at', 'desc')->where('commenter_id', '=' ,$user->id)->get();

        $commentsCount = $comments->count();

        return view('users.comments', ['user' => $user, 'comments' => $comments, 'postsCount' => $postsCount, 'commentsCount' => $commentsCount]);
    }

    public function storeImg(Request $request, $id){

        $validated = $request->validate([
            'imgPath' => 'required',
        ]);

        $user = User::findOrFail($id);

        $file = $request->file('imgPath');
        $filename = date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('images'), $filename);
        $user->img_path = "images/".$filename;

        $user->update();

        return redirect()->back();
    }

    public function getInfo($id){

        $user = User::findOrFail($id);

        $postsCount = $user->posts->count();;

        $comments = $user->comments;

        $commentsCount = $comments->count();

        return view('users.info', ['user' => $user, 'postsCount' => $postsCount, 'commentsCount' => $commentsCount]);
    }

    public function updateInfo(Request $request, $id){

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::findOrFail($id);

        if(Hash::check(request('password'), $user->password)){
            $user->password = Hash::make(request('new_password'));
        }

        $user->name = request('name');

        $user->email = request('email');

        $user->update();

        return redirect()->back()->with('updated','Profile Updated!');
    }

    public function destroy($id){

        $user = User::findOrFail($id);

        $user->delete();

        return redirect('/');
    }
}
