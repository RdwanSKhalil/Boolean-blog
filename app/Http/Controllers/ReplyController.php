<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reply;
use Auth;

class ReplyController extends Controller
{
    public function store(Request $request, $id){

        $validated = $request->validate([
            'reply' => 'required|max:255',
        ]);

        $reply = new reply();

        $reply->post_id = $id;
        $reply->user_id = Auth::user()->id;
        $reply->comment_id = request('comment-id');
        $reply->reply = request('reply');

        $reply->save();

        return redirect()->back();
    }

    public function destroy(){

        $reply = reply::findOrFail(request('reply-id'));

        $reply->delete();

        return redirect()->back();
    }

    public function show($id){

        $reply = reply::findOrFail($id);

        return view('replies.edit', ['reply' => $reply]);
    }

    public function edit($id){

        $reply = reply::findOrFail($id);
        
        $reply->reply = request('text');
        $reply->update();
        
        return redirect(route('show-post', $reply->post_id));
    }
}
