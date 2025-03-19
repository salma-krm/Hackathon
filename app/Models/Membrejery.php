<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membrejery extends Model
{
    use HasFactory;
    protected $fillable =[
        'name','code,'

    ];
    public function  jery(){
        return $this->hasMany(jery::class);
    }
    public function note(){
        return $this->hasMany(note::class);
    }
}
