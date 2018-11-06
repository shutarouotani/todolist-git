@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>マイページ</h1>
        <br>
    </div>
    <div class="row">
        <aside class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $user->name }}</h3>
                </div>
                <div class="panel-body">
                    @if ( $user->image_path == 'noimage.png')
                        <img class="media-object img-rounded img-responsive" src="https://www.gravatar.com/avatar/00000000000000000000000000000000?s=200&r=pg&d=mp" alt="">
                    @else
                        <img class="media-object img-rounded img-responsive" src="{!! $user->image_path !!}" alt="">
                    @endif
                   
                </div>
                <div class="panel-footer">
                    {!! Form::open(['route' => 'upload.post', 'files' => true]) !!}
                    <!--{!! Form::open(['url' => '/upload', 'method' => 'post', 'files' => true]) !!}-->
                        <div class="form-group">
                            {!! Form::label('file', 'プロフィール画像変更', ['class' => 'control-label']) !!}
                            {!! Form::file('file') !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('プロフィール画像アップロード', ['class' => 'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </aside>
        <div class="col-xs-4">
            <div class="mypage_box">
                <div class="box-title">完了</div>
                <p>{{ $user->tantou_tasks()->where('status_id', 3)->count() }} 個</p>
            </div>
            <div class="mypage_box">
                <div class="box-title">未完了</div>
                <p>{{ $user->tantou_tasks()->where('status_id', '<>', 3)->count() }} 個</p>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="mypage_box">
                <div class="box-title">保有タスク</div>
                <p>{{ $user->tantou_tasks()->count() }} 個</p>
            </div>
            <div class="mypage_box">
                <div class="box-title">消化率</div>
                <?php
                    $comp_tasks_count = $user->tantou_tasks()->where('status_id', 3)->count();
                    $tantou_tasks_count = $user->tantou_tasks()->count();
                    if ($tantou_tasks_count == 0) {
                        $parcentage = '--';
                    }
                    else {
                        $parcentage = floor( $comp_tasks_count / $tantou_tasks_count * 100 );
                    }
                ?>
               
                <p>{{ $parcentage }} %</p>
            </div>
        </div>
    </div>
@endsection