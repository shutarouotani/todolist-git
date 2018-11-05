@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>タスク詳細</h1>
        <br>
    </div>
    <div class="row">
        <!--タスク概要-->
        <aside class="col-xs-5">
            @include('tasks.task', ['$task' => $task])
        </aside>
        <!--タスク詳細-->
        <div class="col-xs-7">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="{{ Request::is('tasks/' . $task->id) ? 'active' : '' }}"><a href="{{ route('tasks.show', ['id' => $task->id]) }}">サブタスク</a></li>
                <li role="presentation" class="{{ Request::is('tasks/*/discussions') ? 'active' : '' }}"><a href="{{ route('tasks.discussions', ['id' => $task->id]) }}">ディスカッション</a></li>
                <li role="presentation" class="{{ Request::is('tasks/*/members') ? 'active' : '' }}"><a href="{{ route('tasks.members', ['id' => $task->id]) }}">メンバー</a></li>
            </ul>
            <br>
            {!! Form::open(['route' => 'discussions.store']) !!}
                <div class="form-group">
                    {!! Form::hidden('task_id', $task->id) !!}
                    {!! Form::textarea('message', old('message'), ['class' => 'form-control', 'rows' => '2']) !!}
                    {!! Form::submit('メッセージ追加', ['class' => 'btn btn-primary btn-block']) !!}
                </div>
            {!! Form::close() !!}
            @include('discussions.discussions')
        </div>
    </div>
    
@endsection 