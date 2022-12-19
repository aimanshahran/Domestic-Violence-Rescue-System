<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class BlogPost extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $primaryKey = 'id';

    protected $fillable = [
        'editor_id',
        'title',
        'content',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    protected static function booted()
    {
        static::creating(function ($blogpost) {
            $blogpost->editor_id = Auth::id();
        });
    }
}
