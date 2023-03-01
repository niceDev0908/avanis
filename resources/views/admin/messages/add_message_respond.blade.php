<div class="d-flex no-block comment-row">
    <div class="p-2">
        <span class="round">
            <img src="{{getImage(Auth::user()->id, Auth::user()->image)}}" alt="user" width="50">
        </span>
    </div>
    <div class="w-100">
        <h5 class="font-medium">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h5>
        <p class="m-b-10 text-muted">{!! nl2br(e($message)) !!}</p>
        <div class="comment-footer">
            <span class="text-muted pull-right">{{getFormatedDateTime(date('Y-m-d H:i:s'))}}</span>
        </div>
    </div>
</div>