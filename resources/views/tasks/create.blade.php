@extends('layouts.app')

@section('content')
    
    <!-- 1.モーダルを表示する為のボタン -->
    <!--
    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
        モーダルを表示
    </button>
    -->
    
    <!-- モーダルの中身-->
    <div class="modal" id="modal-create" tabindex="-1">
        <div class="modal-dialog">
    
            <!-- モーダルのコンテンツ -->
            <div class="modal-content">
                <!-- モーダルのヘッダ -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modal-label">タスク追加</h4>
                </div>
                <!-- モーダルのボディ -->
                <div class="modal-body">
                    {!! Form::model($task, ['route' => 'tasks.store']) !!}
                        <div class="form-group">
                            {!! Form::label('title', 'タイトル') !!}
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group form-group-lg">
                            {!! Form::label('content', '内容') !!}
                            {!! Form::text('content', null, ['class' => 'form-control', 'rows' => '3']) !!}
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    {!! Form::label('status', 'ステータス') !!}
                                    {!! Form::select('status', config('status'), null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    {!! Form::label('due_date', '期限') !!}
                                    {!! Form::date('due_date', date('Y-m-d'), ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::submit('新規登録', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
                <!-- モーダルのフッタ -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
@endsection

    