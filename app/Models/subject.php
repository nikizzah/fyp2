<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class subject extends Model
{
    use HasFactory;
    protected $fillable=['subject_id','subject_code', 'subject_name', 'subject_credithr', 'subject_prerequisite', 'subject_category', 'subject_semester', 'subject_year','cs_id'];
    protected $primaryKey = 'subject_id';
    public $timestamps = false;

    public function course_structure()
    {
        return $this->belongsToMany(course_structure::class, 'cs_subject', 'subject_id', 'cs_id')
            ->withTimestamps();
    }


    public function advisees()
    {
        return $this->belongsToMany(advisee::class, 'advisee_subject', 'subject_id', 'advisee_id')
            ->withTimestamps();
    }


    public function grades()
    {
        return $this->hasMany(grade::class, 'subject_id');
    }
}
