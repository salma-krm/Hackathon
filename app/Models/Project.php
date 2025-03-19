<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable=[
       'title' ,'description','lien_github',

    ];
    public function team(){
        return $this->belongsTo(Team::class);
    }
    public function theme(){
        return $this->belongsTo(Theme::class);
    }
}
