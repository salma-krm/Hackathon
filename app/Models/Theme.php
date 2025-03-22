<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function hackathons()
    {
        return $this->belongsToMany(Hackathon::class);
    }

   
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}