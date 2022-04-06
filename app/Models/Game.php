<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function member()
    {
        return $this->hasMany(Member::class);
    }

    public function point()
    {
        return $this->hasOne(Point::class)->latest();
    }
}
