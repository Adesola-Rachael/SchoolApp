<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrolStudent extends Model
{
    use HasFactory;

    protected $fillable = [
       'name',
       'grade', 
       'address',
       'date_of_birth',
       'phone',
       'state',
       'nationality',
       'school_record',
       'birth_certificate',
    ];

}
