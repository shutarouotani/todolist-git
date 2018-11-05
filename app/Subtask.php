<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    protected $fillable = ['content', 'task_id'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}

