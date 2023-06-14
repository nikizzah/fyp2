<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use DB;

class advisee extends Model
{
    use HasFactory, Notifiable;
    protected $fillable=['advisee_id', 'advisee_password', 'advisee_fname', 'advisee_address', 'advisee_town', 'advisee_state', 'advisee_postcode', 'advisee_email', 'advisee_contact', 'advisee_cgpa','advisee_calculateCGPA','cs_id', 'subject_id'];
    protected $primaryKey = 'advisee_id';
    public $keyType = 'string';
    public $timestamps = false;

    public function advisor()
    {
        return $this->belongsTo(advisor::class);
    }

    public function course_structure()
    {
        return $this->belongsTo(course_structure::class, 'cs_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(subject::class, 'advisee_subject', 'advisee_id', 'subject_id')
            ->withPivot('subject_semester')
            ->withPivot('subject_grade')
            ->withTimestamps(); 
    }

    public function grades()
    {
        return $this->hasMany(grade::class, 'advisee_id');
    }
}
