<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comment;
use Str;
use Auth;

class CommentController extends Controller
{
    public function store(Request $request, $id){

        $validated = $request->validate([
            'comment' => 'required',
        ]);

        $comment = new comment();

        $comment->post_id = $id;
        $comment->commenter_id = Auth::user()->id;
        $comment->comment = Str::limit(request('comment'), 1000);

        $comment->save();
        
        return redirect()->back()->with('added', 'Your comment has been added');
    }

    public function show($id){

        $comment = comment::findOrFail($id);

        return view('comments.edit', ['comment' => $comment]);
    }

    public function edit($id){

        $comment = comment::findOrFail($id);
        
        $comment->comment = request('text');
        $comment->update();
        
        return redirect(route('show-post', $comment->post_id));
    }

    public function destroy(){

        $comment = comment::findOrFail(request('comment-id'));

        $comment->delete();

        return redirect()->back()->with('deleted', 'You have deleted your comment!');
    }
}
