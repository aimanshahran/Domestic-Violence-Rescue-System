<?php

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if(!function_exists('chat_user')){
    function chat_user()
    {
        $count = Message::select('from_user AS id')
            ->where('from_user', '=', Auth::user()->id)
            ->get();
        $count = count($count);
        if ($count > 0) {
            $users = Message::select('to_user AS id')
                ->where('from_user', '=', Auth::user()->id)
                ->groupBy('to_user')
                ->get();
        } else {
            $users = Message::select(DB::raw('COUNT(DISTINCT(from_user)) AS total'), 'to_user AS id', 'name')
                ->leftJoin('users', 'chat.to_user', '=', 'users.id')
                ->where('users.role_id', '=', '3')
                ->groupBy('id', 'name')
                ->orderBy('total', 'ASC')
                ->limit(1)
                ->get();
        }
        return $users;
    }
}
