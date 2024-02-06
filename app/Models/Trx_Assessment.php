<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trx_Assessment extends Model
{
    use HasFactory;

    protected $table = 'trx_assessments';

    protected $fillable = [
        'teaching_id',
        'student_id',
        'uh',
        'uts',
        'uas',
        'na',
    ];

    public function teaching()
    {
        return $this->belongsTo(Trx_Teaching::class, 'teaching_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(M_Student::class, 'student_id', 'id');
    }
}
