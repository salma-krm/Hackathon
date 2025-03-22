<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuryMember extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'pin',
        
    ];

    

  
    public function jury()
    {
        return $this->belongsTo(Jury::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}