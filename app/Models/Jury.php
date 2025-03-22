<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jury extends Model
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

    /**
     * Get the jury members for the jury.
     */
    public function members()
    {
        return $this->hasMany(JuryMember::class);
    }

  
    public function notedTeams()
    {
        return $this->hasMany(Team::class, 'noter_id');
    }

    public function aidedTeams()
    {
        return $this->hasMany(Team::class, 'aider_id');
    }
}

