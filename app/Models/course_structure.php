<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course_structure extends Model
{
    use HasFactory;
    protected $fillable=['cs_id', 'cs_intake', 'total_advisees'];
    protected $primaryKey = 'cs_id';
    public $timestamps = false;

    public function advisees()
    {
        return $this->hasMany(advisee::class, 'cs_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(subject::class, 'cs_subject', 'cs_id', 'subject_id')
            ->withTimestamps();
    }
    
}
