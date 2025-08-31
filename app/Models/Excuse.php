<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Excuse extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'emp_id');
    }

    public function approved()
    {
        return $this->belongsTo(Employee::class,'approved_by_id');
    }

}
