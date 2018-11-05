<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Task;

class UserTaskController extends Controller
{
    /*
    public function store(Request $request, $id)
    {
        \Auth::user()->favorite($id);
        return redirect()->back();
    }

    public function destroy($id)
    {
        \Auth::user()->unfavorite($id);
        return redirect()->back();
    }
    */
    
    public function members($id)
    {
        $task = Task::find($id);
        $members = $task->share_users()->get();
        
        $tantou = $task->tantou_users()->first();
        
        $user_ids = [];
        foreach ($members as $member) {
            $user_ids[] = $member->id;
        };
        
        $unshare_members = User::all()->whereNotIn('id', $user_ids);

        $data = [
            'task' => $task,
            'members' => $members,
            'tantou' => $tantou,
            'unshare_members' => $unshare_members,
        ];
        
        return view('tasks.members', $data);
    }
    
    // 共有メンバー変更
    public function changemember(Request $request, $id)
    {
        $task = Task::find($id);
        $tantou = $task->tantou_users()->first();
        
        $task->delete_member();
        if (!empty($request->share)) {
            foreach( $request->share as $value ){
                $task->add_member($value);
            };
        };
        
        $members = $task->share_users()->get();
        
        $user_ids = [];
        foreach ($members as $member) {
            $user_ids[] = $member->id;
        };
        $unshare_members = User::all()->whereNotIn('id', $user_ids);
        
        $data = [
            'task' => $task,
            'members' => $members,
            'tantou' => $tantou,
            'unshare_members' => $unshare_members,
        ];
        
        return view('tasks.members', $data);
    }
}
