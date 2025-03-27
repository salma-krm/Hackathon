<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hackathon extends Model
{
    use HasFactory;

    protected $table="hackathon";
    protected $fillable = [
        'date',
        'place',   
    ];
    public function themes()
    {
        return $this->hasMany(Theme::class);
    }

    public function rules()
    {
        return $this->belongsToMany(Rule::class,'rules_hackathon','hackathon_id','rule_id');
    }   

   
    public function team()
    {
        return $this->hasMany(Team::class);
    }

    public function organisateur()
    {
        return $this->belongsTo(User::class, 'organisateur_id');
    }
}
