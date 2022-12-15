<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class DVInfo extends Model
{
    use HasFactory;

    protected $table = 'dv_information';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'user_id',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($dvinfo) {
            $dvinfo->user_id = Auth::id();
        });
    }
}
