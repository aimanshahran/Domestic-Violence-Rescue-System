@if($message->from_user == \Auth::user()->id)
    <div class="row msg_container base_sent" data-message-id="{{ $message->id }}" id="message-line-{{$message->id}}">
        <div class="col-md-12 col-xs-9">
            <div class="messages msg_sent text-right">
                <p>{!! $message->content !!}</p>
                <time datetime="{{ date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString())) }}">{{ $message->fromUser->name }} • {{ $message->created_at->diffForHumans() }}</time>
            </div>
        </div>
    </div>
@else
    <div class="row msg_container base_receive" data-message-id="{{ $message->id }}" id="message-line-{{$message->id}}">
        <div class="col-md-12 col-xs-9">
            <div class="messages msg_receive text-left">
                <p>{!! $message->content !!}</p>
                <time datetime="{{ date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString())) }}">{{ $message->fromUser->name }} • {{ $message->created_at->diffForHumans() }}</time>
            </div>
        </div>
    </div>
@endif
