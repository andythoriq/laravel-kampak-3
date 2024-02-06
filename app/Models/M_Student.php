<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class M_Student extends User
{
    use HasFactory;

    protected $table = 'm_students';

    protected $fillable = [
        'nis',
        'name',
        'gender',
        'address',
        'class_id',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function username()
    {
        return 'nis';
    }

    public function class ()
    {
        return $this->belongsTo(M_Class::class, 'class_id', 'id');
    }
}
