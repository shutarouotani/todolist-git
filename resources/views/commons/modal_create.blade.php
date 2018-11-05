<!-- モーダルの中身-->
<div class="modal" id="modal-create" tabindex="-1" role="dialog">
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
                {!! Form::open(['route' => 'tasks.store']) !!}
                <div class="form-group">
                    {!! Form::label('title', 'タイトル') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group form-group">
                    {!! Form::label('content', '内容') !!}
                    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '3']) !!}
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
            </div>
            <!-- モーダルのフッタ -->
            <div class="modal-footer">
                {!! Form::submit('新規登録', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
                <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>