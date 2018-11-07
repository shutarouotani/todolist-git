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
                @if ( $user->image_path == null)
                    <img class="media-object img-rounded message__profile" src="https://www.gravatar.com/avatar/00000000000000000000000000000000?s=200&r=pg&d=mp" alt="">
                @else
                    <img class="media-object img-rounded message__profile" src="{!! $user->image_path !!}" alt="">
                @endif
            </div>
        </li>
    @else
        <li class="media message--received">
            <div class="media-left">
                @if ( $user->image_path == null)
                    <img class="media-object img-rounded message__profile" src="https://www.gravatar.com/avatar/00000000000000000000000000000000?s=200&r=pg&d=mp" alt="">
                @else
                    <img class="media-object img-rounded message__profile" src="{!! $user->image_path !!}" alt="">
                @endif
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