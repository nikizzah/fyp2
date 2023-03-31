<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class advisee extends Model
{
    use HasFactory;
    protected $fillable=['advisee_id', 'advisee_password', 'advisee_fname', 'advisee_address', 'advisee_town', 'advisee_state', 'advisee_postcode', 'advisee_email', 'advisee_contact', 'advisee_cgpa'];
    //protected $guarded = [];
    protected $primaryKey = 'advisee_id';
    public $keyType = 'string';
    public $timestamps = false;

    public function advisor()
    {
        return $this->belongsTo(advisor::class);
    }
}
