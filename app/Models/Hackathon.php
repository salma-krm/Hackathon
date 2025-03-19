<?php

namespace App\Models;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hackathon extends Model
{
    use HasFactory;
    protected $fillable=[
 'date','lieu',
];

public function rules(){
    return $this->hasMany(Rule::class);
}
public function theme(){
    return $this->hasMany(Theme::class);
}
}
