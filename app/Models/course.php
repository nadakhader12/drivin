<?php

namespace App\Models;

use App\Models\team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class course extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=[];

    public function team()
    {
        return $this->BelongsTo(team::class)->withDefault();
    }
}
