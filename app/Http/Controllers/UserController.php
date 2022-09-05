<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB, File, Hash;

class UserController extends Controller
{
    public function show($id){

        $user = User::findOrFail($id);

        return view('users.show', ['user' => $user]);
    }

    public function posts($id){

        $user = User::findOrFail($id);

        foreach($user->posts as $post){
            if(File::exists($post->img_path) == false){
                $post->img_path = "images/placeholder-img.webp"; 
            }
        }

        return view('users.posts', ['user' => $user]);
    }

    public function comments($id){

        $user = User::findOrFail($id);

        return view('users.comments', ['user' => $user]);
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

        return view('users.info', ['user' => $user]);
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
