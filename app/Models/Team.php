<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

   
    public function hackathon()
    {
        return $this->belongsTo(Hackathon::class,'hackathon_id');
    }

    public function noter()
    {
        return $this->belongsTo(Jury::class, 'noter_id');
    }
    public function aider()
    {
        return $this->belongsTo(Jury::class, 'aider_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}

