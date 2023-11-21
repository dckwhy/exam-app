<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExam extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function child(){
        return $this->belongsTo(User::class, 'child_id', 'id');
    }

    public function tier(){
        return $this->belongsTo(Tier::class, 'tier_id', 'id');
    }

    public function parent(){
        return $this->belongsTo(User::class, 'parent_id', 'id');
    }
}
