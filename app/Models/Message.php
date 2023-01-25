<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = "chat";

    protected $appends = ['date_time_str', 'date_human_readable', 'image_url'];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user');
    }

    public function getDateTimeStrAttribute()
    {
        return date("Y-m-dTH:i", strtotime($this->created_at->toDateTimeString()));
    }

    public function getDateHumanReadableAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? url('/') . '/uploads/' . $this->image : "";
    }
}
