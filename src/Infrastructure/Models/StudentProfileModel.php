<?php

namespace Src\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProfileModel extends Model
{
    protected $table = 'student_profiles';

    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'filiere',
        'date_naissance',
        'status'
    ];
}
