<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Task;

use App\Discussion;

class DiscussionsController extends Controller
{
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'message' => 'required|max:191',
        ]);
        
        $user = \Auth::user();
        
        $discussion = new Discussion;
        $discussion->user_id = $user->id;
        $discussion->message = $request->message;
        $discussion->task_id = $request->task_id;
        $discussion->save();
        
        /*
        $request->task()->subtasks()->create([
            'content' => $request->content,
        ]);
        */
        return redirect()->back();
    }
}
