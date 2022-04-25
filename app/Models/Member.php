<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public function score()
    {
        return $this->hasMany(Score::class);
    }

    public function memberLib()
    {
        return $this->belongsTo(MemberLib::class);
    }
}
