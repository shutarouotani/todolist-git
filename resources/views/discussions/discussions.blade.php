<ul class="media-list">
@foreach ($discussions as $discussion)
    <?php $user = $discussion->user; ?>
    @if ( Auth::user() == $user)
        <li class="media message--sent">
            <div class="media-body">
                <div class="message__body">
                    <div class="message__user-name">
                        {{$user->name}} さんのメッセージ
                    </div>
                    <div class="message__text">
                        <p>{!! nl2br(e($discussion->message)) !!}</p>
                    </div>
                    <div class="message__time">
                        {{$discussion->created_at}}
                    </div>
                </div>
            </div>
            <div class="media-right">
                <img class="media-object img-rounded message__profile" src="/storage/{{$user->image_path}}" alt="">
            </div>
        </li>
    @else
        <li class="media message--received">
            <div class="media-left">
                <img class="media-object img-rounded message__profile" src="/storage/{{$user->image_path}}" alt="">
            </div>
            <div class="media-body">
                <div class="message__body">
                    <div class="message__user-name">
                        {{$user->name}} さんからのメッセージ
                    </div>
                    <div class="message__text">
                        <p>{!! nl2br(e($discussion->message)) !!}</p>
                    </div>
                    <div class="message__time">
                        {{$discussion->created_at}}
                    </div>
                </div>
            </div>
        </li>
    @endif
        
@endforeach
</ul>
{!! $discussions->render() !!}