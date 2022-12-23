<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyPhoto extends Model
{
    use HasFactory;

    protected $table = 'emergency_photo';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'case_id',
        'photo_name'
    ];

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setFilenamesAttribute($value)
    {
        $this->attributes['photo_name'] = json_encode($value);
    }
}
