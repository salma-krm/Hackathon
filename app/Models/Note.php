<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'value',
    ];

  
    public function juryMember()
    {
        return $this->belongsTo(JuryMember::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}