<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class subject extends Model
{
    use HasFactory;
    protected $fillable=['subject_code', 'subject_name', 'subject_credithr', 'subject_prerequisite', 'subject_category', 'subject_semester', 'subject_year'];
    // protected $primaryKey = 'subject_code';
    // public $keyType = 'string';
    public $timestamps = false;
}
