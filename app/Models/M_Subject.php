<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Subject extends Model
{
    use HasFactory;

    protected $table = 'm_subjects';

    protected $fillable = [
        'title',
    ];

    public static function get_subjects()
    {
        return self::select(['id', 'title'])->orderBy('title')->get();
    }
}
