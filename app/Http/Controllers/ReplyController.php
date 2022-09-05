<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reply;
use App\Models\comment;
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

        return redirect()->back()->with('reply-stored', 'Your reply has been added');;
    }

    public function destroy(){

        $reply = reply::findOrFail(request('reply-id'));

        $reply->delete();

        return redirect()->back()->with('reply-deleted', 'Your reply has been deleted!');
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

    public function storeReply(Request $request, $id){

        $validated = $request->validate([
            'reply' => 'required|max:255',
        ]);

        $reply = new reply();

        $comment = comment::findOrFail(request('comment-id'));

        $reply->reply = request('reply');
        $reply->reply_id = $id;
        $reply->post_id = $comment->post_id;
        $reply->user_id = Auth::user()->id;
        $reply->comment_id = $comment->id;

        $reply->save();

        return redirect()->back()->with('reply-stored', 'Your reply has been added');
    }
}
