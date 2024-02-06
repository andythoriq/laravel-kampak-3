<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Class extends Model
{
    use HasFactory;

    protected $table = 'm_classes';

    protected $fillable = [
        'grade',
        'major',
        'group',
    ];

    public static $grades = ['X', 'XI', 'XII', 'XIII'];

    public static $majors = ['DKV', 'BKP', 'DPIB', 'RPL', 'SIJA', 'TKJ', 'TOI', 'TKR', 'TFLM'];

    public static $groups = ['1', '2', '3', '4'];

    public static function get_classes()
    {
        return self::select(['id', \DB::raw("CONCAT(grade,' ',major,' ',m_classes.group) as class")])->
            orderBy('major')->orderBy('grade')->orderBy('m_classes.group')->get();
    }
}
