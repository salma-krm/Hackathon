<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    
    public function hackathon()
    {
        return $this->belongsToMany(Hackathon::class,'rules_hackathon','hackathon_id','rule_id');
    }
}