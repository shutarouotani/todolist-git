<?php
    $due_date = new DateTime( $task->due_date);
    $due_date_y = $due_date->format('Y');
    $due_date_m = $due_date->format('m');
    $due_date_d = $due_date->format('d');
    $due_date_ymd = $due_date_y . "-" . $due_date_m . "-" . $due_date_d;
    $tantou = $task->tantou_users()->first();
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">タスク概要</h3>
    </div>
    <div class="panel-body">
        @if ( Auth::user()->id == $tantou->id)
            {!! Form::open(['route' => ['tasks.update', $task->id], 'method' => 'put']) !!}
            <div class="form-group">
                {!! Form::label('title', 'タイトル') !!}
                {!! Form::text('title', $task->title, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group form-group">
                {!! Form::label('content', '内容') !!}
                {!! Form::textarea('content', $task->content, ['class' => 'form-control', 'rows' => '3']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('status', 'ステータス') !!}
                {!! Form::select('status', config('status'), $task->status_id, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('due_date', '期限') !!}
                {!! Form::date('due_date', $due_date_ymd, ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit('編集内容反映', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        @else
            {!! Form::open() !!}
            <div class="form-group">
                {!! Form::label('title', 'タイトル') !!}
                {!! Form::text('title', $task->title, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
            </div>
            <div class="form-group form-group">
                {!! Form::label('content', '内容') !!}
                {!! Form::textarea('content', $task->content, ['class' => 'form-control', 'rows' => '3', 'disabled' => 'disabled']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('status', 'ステータス') !!}
                {!! Form::select('status', config('status'), $task->status_id, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('due_date', '期限') !!}
                {!! Form::text('due_date', $due_date_ymd, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
            </div>
            {!! Form::close() !!}
        @endif
    </div>
</div>