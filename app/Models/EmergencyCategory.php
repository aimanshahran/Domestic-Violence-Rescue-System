<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyCategory extends Model
{
    use HasFactory;

    protected $table = 'emergency_case_category';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'emergency_id',
        'case_category_id'
    ];
}
