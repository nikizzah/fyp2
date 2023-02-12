<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    use HasFactory;
    protected $primaryKey = 'subject_code';
    public $keyType = 'string';
    public $timestamps = false;
}
