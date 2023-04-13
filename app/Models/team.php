<?php

namespace App\Models;

use App\Models\course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class team extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=[];

    public function course()
    {
        return $this->hasMany(course::class)->withDefault();
    }
}
