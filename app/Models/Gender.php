<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $table = 'gender';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'type',
    ];
}
