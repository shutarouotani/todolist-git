<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'content', 'due_date', 'status_id'];
    
    protected $appends = ['status'];
    
    public function getStatusAttribute()
    {
        return \Config::get('status.'.$this->status_id);
    }
    
    public function share_users()
    {
        return $this->belongsToMany(User::class, 'user_task', 'task_id', 'user_id')->withPivot('type')->withTimestamps();
    }
    
    public function tantou_users()
    {
        return $this->share_users()->where('type', 'tantou');
    }
    
    public function not_tantou_users()
    {
        return $this->share_users()->where('type', '<>','tantou');
    }
    
    public function subtasks()
    {
        return $this->hasMany(Subtask::class);
    }
    
    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }
    
    public function delete_member()
    {
        // 共有メンバーが存在するか確認
        $exist = $this->not_tantou_users()->exists();

        if ($exist) {
            // 共有メンバーを削除
            \DB::table('user_task')->where([
                ['task_id', '=', $this->id],
                ['type', '<>', 'tantou'],
            ])->delete();
        }
    }
    
    public function add_member($userId)
    {
        // 既に 共有 しているかの確認
        $exist = $this->not_tantou_users()->where('user_id', '=',$userId)->exists();

        if ($exist) {
            // 既に 共有 していれば何もしない
            return false;
        } else {
            // 未共有 であれば 共有 する
            \DB::table('user_task')->insert(
                ['user_id' => $userId, 'task_id' => $this->id, 'type' => '']
            );
            return true;
        }
    }
}
