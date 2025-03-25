<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;
protected $table='theme';
    protected $fillable = [
        'name',
        'description',
    ];

    public function hackathon()
    {
        return $this->belongsTo(Hackathon::class,'hackathon_id');
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}