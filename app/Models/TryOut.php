<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryOut extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tier(){
        return $this->belongsTo(Tier::class, 'tier_id', 'id');
    }
}
