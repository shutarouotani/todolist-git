<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function share_tasks()
    {
        return $this->belongsToMany(Task::class, 'user_task', 'user_id', 'task_id')->withPivot('type')->withTimestamps();
    }

    public function tantou_tasks()
    {
        return $this->share_tasks()->where('type', 'tantou');
    }
    
    public function assign_tantou($taskId)
    {
        // 既に担当しているかの確認
        $exist = $this->tantou_check($taskId);

        if ($exist) {
            // 既に担当していれば何もしない
            return false;
        } else {
            // 担当外であればアサインする
            $this->share_tasks()->attach($taskId, ['type' => 'tantou']);
            return true;
        }
    }

    public function withdraw_tantou($taskId)
    {
        // 既に担当しているかの確認
        $exist = $this->tantou_check($taskId);

        if ($exist) {
            // 既に担当していれば担当から外す
            \DB::update("UPDATE user_task set type = null WHERE user_id = ? AND task_id = ? AND type = 'tantou'", [$this->id, $taskId]);
        } else {
            // 担当外であれば何もしない
            return false;
        }
    }
    
    public function tantou_check($taskId)
    {
        $task_id_exists = $this->tantou_tasks()->where('task_id', $taskId)->exists();
        return $task_id_exists;
    }
}
