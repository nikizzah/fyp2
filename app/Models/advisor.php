<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class advisor extends Model
{
    use HasFactory;
    protected $primaryKey = 'advisor_id';
    public $keyType = 'string';
    public $timestamps = false;
}
