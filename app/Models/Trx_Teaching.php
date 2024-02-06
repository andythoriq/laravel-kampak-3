<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trx_Teaching extends Model
{
    use HasFactory;

    protected $table = 'trx_teachings';

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'class_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(M_Teacher::class, 'teacher_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(M_Subject::class, 'subject_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(M_Class::class, 'class_id', 'id');
    }
}
