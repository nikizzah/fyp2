<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class advisee extends Model
{
    use HasFactory;
    protected $primaryKey = 'advisee_id';
    public $keyType = 'string';
    public $timestamps = false;
}
