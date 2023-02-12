<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hop extends Model
{
    use HasFactory;
    protected $primaryKey = 'hop_id';
    public $keyType = 'string';
    public $timestamps = false;
}
