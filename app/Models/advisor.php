<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class advisor extends Model
{
    use HasFactory;
    protected $fillable=['advisor_id', 'advisor_password', 'advisor_name', 'advisor_ext', 'advisor_email', 'advisor_quota', 'advisor_position'];
    protected $primaryKey = 'advisor_id';
    public $keyType = 'string';
    public $timestamps = false;

    public function advisee()
    {
        return $this->hasMany(advisee::class);
    }
}
