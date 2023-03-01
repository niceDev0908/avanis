<li class="right">
    <div class="conversation-list">
        <div class="ctext-wrap">
            <div class="conversation-name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</div>
            <p>{!! nl2br(e($message)) !!}</p>
            <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> {{getFormatedDateTime(Carbon\Carbon::now())}}</p>
        </div>
    </div>
</li>