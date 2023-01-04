<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseCategory extends Model
{
    use HasFactory;

    protected $table = 'case_category';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'emergency_id',
        'case_category_id',
        'severity_status_id'
    ];


}
