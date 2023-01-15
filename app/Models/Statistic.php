<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $table = 'dv_statistics';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'year',
        'data',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
