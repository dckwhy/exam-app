<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function try_outs(){
        return $this->hasMany(TryOut::class, 'tier_id');
    }
}
