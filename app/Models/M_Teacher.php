<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class M_Teacher extends User
{
    use HasFactory;

    protected $table = 'm_teachers';

    protected $fillable = [
        'nip',
        'name',
        'gender',
        'address',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function username()
    {
        return 'nip';
    }

    public static function get_teachers()
    {
        return self::select(['id', \DB::raw("CONCAT(name,' - ',nip) as teacher")])->orderBy('name')->get();
    }
}
