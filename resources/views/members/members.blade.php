<div>
    @if ( Auth::user()->id == $tantou->id)
    	<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ChangeMemberModal">
	        共有メンバー変更
	    </button>
    @endif
</div>
<br>
<ul class="media-list list-inline">
@foreach ($members as $member)
    <li><img class="media-object img-rounded member__profile" src="/storage/{{$member->image_path}}" alt="">{!! $member->name !!}</li>
@endforeach
</ul>

<!-- モーダル・ダイアログ -->
<div class="modal fade" id="ChangeMemberModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span>×</span></button>
				<h4 class="modal-title">共有メンバー変更</h4>
			</div>
		    {!! Form::open(['route' => ['changemember.post', $task->id]]) !!}
			<div class="modal-body">
				<div class="row">
			        <select name="share[]" class="col-xs-3 col-xs-offset-1" id="share_select" size="10" multiple="multiple">
				        @foreach ($members as $member)
				            @if ( $member <> $tantou)
				                <option value="{{$member->id}}">{!! $member->name !!}</option>
				            @endif
				        @endforeach
				    </select>
				    <div class="col-xs-2">
				        <br>
					        <div><button type="button" class="btn btn-primary" onclick="addmember_onclick()">◀メンバー追加</button></div>
                        <br>
                        <div><button type="button" class="btn btn-primary" onclick="removemember_onclick()">▶メンバー削除</button></div>
				    </div>
			        <select name="unshare[]" class="col-xs-3 col-xs-offset-1" id="unshare_select" size="10" multiple="multiple">
				        @foreach ($unshare_members as $unshare_member)
				            <option value="{{$unshare_member->id}}">{!! $unshare_member->name !!}</option>
				        @endforeach
				    </select>
				</div>
			</div>
			<div class="modal-footer">
			    <button type="submit" class="btn btn-primary" onclick="select_onclick()">更新</button>
			    {!! Form::close() !!}
				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
			</div>
		</div>
	</div>
</div>

<script>
function addmember_onclick() {
  let op;
  var sel = document.getElementById("unshare_select");
  // 選択値をリストに追加
  for (var i = sel.length - 1; 0 <= i; --i) {
    if (sel[i].selected) { 
        op = document.createElement("option");
        op.value = sel[i].value;
        op.text = sel[i].text;
        document.getElementById("unshare_select").removeChild(sel[i]);
        document.getElementById("share_select").appendChild(op);
    }
  }
}

function removemember_onclick() {
  let op;
  var sel = document.getElementById("share_select");
  // 選択値をリストに追加
  for (var i = sel.length - 1; 0 <= i; --i) {
    if (sel[i].selected) { 
        op = document.createElement("option");
        op.value = sel[i].value;
        op.text = sel[i].text;
        document.getElementById("share_select").removeChild(sel[i]);
        document.getElementById("unshare_select").appendChild(op);
    }
  }
}

function select_onclick() {
  let op;
  var sel = document.getElementById("share_select");
  // 選択値をリストに追加
  for (var i = sel.length - 1; 0 <= i; --i) {
    sel[i].selected = true;
  }
}
</script>



