<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hackathon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'place',
        'organisateur_id',
       
    ];

   
    public function themes()
    {
        return $this->belongsToMany(Theme::class);
    }

    public function rules()
    {
        return $this->belongsToMany(Rule::class);
    }

   
    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'organisateur_id');
    }
}
