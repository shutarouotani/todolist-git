@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>タスク一覧</h1>
        <br>
    </div>
    <div class="row">
        <!-- 検索条件 -->
        <aside class="col-xs-5">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">検索条件</h3>
                </div>
                <div class="panel-body">
                    {!! Form::open(['method' => 'GET']) !!}
                        <div class="form-group">
                            {!! Form::label('keyword', 'キーワード') !!}
                            {!! Form::text('keyword', null, ['class' => 'form-control']) !!}
                        </div><br>
                        <!--
                        <div class="form-group">
                            {!! Form::label('tantou', 'メンバー') !!}
                            {!! Form::text('tantou', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('tantou', '自分が担当しているタスクのみ') !!}
                            {!! Form::checkbox('mytask', 1, true) !!}
                        </div>
                        -->
                        <div class="form-group">
                            {!! Form::label('status', 'ステータス') !!}
                            {!! Form::select('status', config('status_s'), null, ['class' => 'form-control']) !!}
                        </div><br>
                        <div class="form-group">
                            {!! Form::label('due_date', '期限') !!}
                            <div class="row">
                                <div class="col-sm-5">
                                    {!! Form::date('due_date_from', date('Y-m-d'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-sm-1">~</div>
                                <div class="col-sm-5">
                                    {!! Form::date('due_date_to', date('Y-m-d'), ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div><br>
                        {!! Form::submit('検索', ['class' => 'btn btn-primary']) !!}
                        {{Form::reset('クリア', ['class' => 'btn btn-default'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </aside>
        <!-- 検索結果 -->
        <div class="col-xs-7">
            
            @if (count($tasks) > 0)
                <table class="table table-striped">
                    <thread>
                        <tr class="info">
                            <th>タイトル</th>
                            <th>期限</th>
                            <!--<th>担当者</th>-->
                            <th>ステータス</th>
                        </tr>
                    </thread>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{!! link_to_route('tasks.show', $task->title, ['id' => $task->id]) !!}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>{{ $task->status }}</td>
                            </tr>
                        @endforeach
                        {!! $tasks->render() !!}
                    </tbody>
                </table>
            @else
                <h2>条件に合致するタスクが存在しません。</h2>
            @endif
        </div>
    </div>
@endsection
