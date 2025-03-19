<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jery extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
    ];
    public function hackathon(){
        return $this->belongsto(Hackathon::class);
    }
    public function  membrejery(){
        return $this->belongsto(membrejery::class);
    }
}
