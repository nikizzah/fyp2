<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cs extends Model
{
    use HasFactory;
    protected $primaryKey = 'cs_id';
    public $keyType = 'string';
    public $timestamps = false;
}
