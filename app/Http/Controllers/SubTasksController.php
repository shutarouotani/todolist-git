<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subtask;

class SubTasksController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $subtasks = $task->subtasks()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'subtasks' => $subtasks,
            ];
            //$data += $this->counts($user);
            return view('tasks.show', $data);
        }else {
            return view('welcome');
        }
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'subcontent' => 'required|max:191',
        ]);
        
        
        $subtask = new Subtask;
        $subtask->content = $request->subcontent;
        $subtask->task_id = $request->task_id;
        $subtask->save();
        
        /*
        $request->task()->subtasks()->create([
            'content' => $request->content,
        ]);
        */
        return redirect()->back();
    }
    
    public function destroy($id)
    {
        $micropost = \App\Micropost::find($id);

        if (\Auth::id() === $micropost->user_id) {
            $micropost->delete();
        }

        return redirect()->back();
    }
}
