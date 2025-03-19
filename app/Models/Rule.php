<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
      ];

  public function hackathon() {
    return $this->belongsto(Hackathon::class);
}
}
