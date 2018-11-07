<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Task;

class TasksController extends Controller
{
    
    public function index(Request $request)
    {
        
        $data = [];
        if (\Auth::check()) {
            
            $user = \Auth::user();
            $tasks = $user->share_tasks();
            
            //検索条件(キーワード)
            if ($request->has('keyword')) {
                $outer_variable = $request->keyword;
                $tasks->where(function ($tasks) use ($outer_variable) {              
                    $tasks->where('title','like','%'.$outer_variable.'%')
                          ->orWhere('content','like','%'.$outer_variable.'%');
                });
            };
            //検索条件(ステータス)
            if ($request->has('status') & $request->status <> 0) {
                $tasks = $tasks->where('status_id', $request->status);
            };
            //検索条件(期限from)
            if ($request->due_date_from <> '' ) {
                $tasks = $tasks->where('due_date', '>=', $request->due_date_from);
            };
            
            //検索条件(期限to)
            if ($request->due_date_from <> '' ) {
                $tasks = $tasks->where('due_date', '<=', $request->due_date_to);
            };
            
            $tasks = $tasks->orderBy('created_at', 'asc')->paginate(10);

            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
            //$data += $this->share_task_counts($user);
            return view('tasks.index', $data);
                
        } else {
            return view('auth.login');
        }
    }
    
    public function show($id)
    {
        $task = \App\Task::find($id);
        return view('tasks.show', ['task' => $task,]);
        
        /*
        if (\Auth::id() === $task->user_id) {
            return view('tasks.show', ['task' => $task,]);
        } else {
            return redirect('/');
        }
        */
    }
    
    public function create()
    {
        if (\Auth::check()) {
            $task = new Task;
            return view('tasks.create', ['task' => $task,]);
        }else {
            return view('login');
        }
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:191',
        ]);
        
        $this->validate($request, [
            'content' => 'required|max:191',
        ]);
        
        /*
        $request->user()->tasks()->create([
            'status' => $request->status,
            'content' => $request->content,
        ]);
        */
        
        $task = new Task;
        $task->title = $request->title;
        $task->content = $request->content;
        $task->status_id = $request->status;
        $task->due_date = $request->due_date;
        $task->save();
        
        $last_insert_id = $task->id;
        \Auth::user()->assign_tantou($last_insert_id);
        
        //return redirect('/');
        return redirect()->back();
    }
    
    public function discussions($id)
    {
        $task = Task::find($id);
        $discussions = $task->discussions()->orderBy('created_at', 'asc')->paginate(10);

        $data = [
            //'user' => $user,
            'task' => $task,
            'discussions' => $discussions,
        ];

        //$data += $this->counts($user);

        return view('tasks.discussions', $data);
    }
    
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->title = $request->title;
        $task->content = $request->content;
        $task->status_id = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return view('tasks.show', ['task' => $task,]);
    }
}
