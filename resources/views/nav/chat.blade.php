<div class="chat-wrap">
    @php
        $users = chat_user();
    @endphp
    @foreach($users as $user)
    <a type="button" href="javascript:void(0);" class="chat-toggle" data-id="{{ $user->id }}" data-user="Counselor" data-toggle="tooltip" data-placement="left" title="Chat with our counselor!">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="60px" height="60px" viewBox="0,0,256,256"><g fill="#622c8c" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(16,16)"><path d="M4,15.43359v-2.43359h-1.5c-0.82812,0 -1.5,-0.67187 -1.5,-1.5v-8c0,-0.82812 0.67188,-1.5 1.5,-1.5h10c0.82813,0 1.5,0.67188 1.5,1.5v8c0,0.82813 -0.67187,1.5 -1.5,1.5h-4.84766z"></path></g></g></svg>
    </a>
    @endforeach
</div>
<div id="chat-overlay" class="row-chat"></div>
</div>
<input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
@include('chat/chat-box')

