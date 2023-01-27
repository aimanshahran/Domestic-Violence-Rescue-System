<?php


namespace App\Http\Controllers;


use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       $users = Message::select('from_user AS id', 'users.id', 'users.name', 'users.phone')
           ->leftJoin('users', 'chat.from_user', '=', 'users.id')
           ->where('to_user', '=', Auth::user()->id)
           ->groupBy('from_user', 'users.id', 'users.name', 'users.phone')
           ->get();

       return view ('chat.index', compact('users'));
    }

    /**
     * getLoadLatestMessages
     *
     *
     * @param Request $request
     */
    public function getLoadLatestMessages(Request $request)
    {
        if(!$request->user_id) {
            return;
        }
        $messages = Message::where(function($query) use ($request) {
            $query->where('from_user', Auth::user()->id)->where('to_user', $request->user_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('from_user', $request->user_id)->where('to_user', Auth::user()->id);
        })->orderBy('created_at', 'DESC')->limit(10)->get();
        $return = [];
        foreach ($messages->reverse() as $message) {
            $return[] = view('chat/message-line')->with('message', $message)->render();
        }
        return response()->json(['state' => 1, 'messages' => $return]);
    }

    /**
     * postSendMessage
     *
     * @param Request $request
     */
    public function postSendMessage(Request $request)
    {
        if(!$request->to_user || !$request->message) {
            return;
        }

        $message = new Message();

        $message->from_user = Auth::user()->id;

        $message->to_user = $request->to_user;

        if($request->message != '' && $request->message != null && $request->message != 'null')  {

            $message->content = $request->message;
        } else {
            if($request->hasFile("image")) {
                $filename = $this->uploadImage($request);
                $message->image = $filename;
            }
        }
        $message->save();


        // prepare the message object along with the relations to send with the response
        $message = Message::with(['fromUser', 'toUser'])->find($message->id);

        // fire the event
        \event(new MessageSent($message));

        return response()->json(['state' => 1, 'message' => $message]);
    }

    /**
     * getOldMessages
     *
     * we will fetch the old messages using the last sent id from the request
     * by querying the created at date
     *
     * @param Request $request
     */
    public function getOldMessages(Request $request)
    {
        if(!$request->old_message_id || !$request->to_user)
            return;

        $message = Message::find($request->old_message_id);

        $previousMessages = $this->getPreviousMessages($request, $message);

        $return = [];

        $noMoreMessages = true;

        if($previousMessages->count() > 0) {

            foreach ($previousMessages as $message) {

                $return[] = view('chat/message-line')->with('message', $message)->render();
            }

            $noMoreMessages = !($this->getPreviousMessages($request, $previousMessages[$previousMessages->count() - 1])->count() > 0);
        }

        return response()->json(['state' => 1, 'messages' => $return, 'no_more_messages' => $noMoreMessages]);
    }

    /**
     * @param Request $request
     * @param $message
     * @return mixed
     */
    private function getPreviousMessages(Request $request, $message)
    {
        $previousMessages = Message::where(function ($query) use ($request, $message) {
            $query->where('from_user', Auth::user()->id)
                ->where('to_user', $request->to_user)
                ->where('created_at', '<', $message->created_at);
        })
            ->orWhere(function ($query) use ($request, $message) {
                $query->where('from_user', $request->to_user)
                    ->where('to_user', Auth::user()->id)
                    ->where('created_at', '<', $message->created_at);
            })
            ->orderBy('created_at', 'DESC')->limit(10)->get();

        return $previousMessages;
    }

    private function uploadImage($request)
    {
        $file = $request->file('image');
        $filename = md5(uniqid()) . "." . $file->getClientOriginalExtension();

        $file->move(public_path('uploads'), $filename);

        return $filename;
    }
}
