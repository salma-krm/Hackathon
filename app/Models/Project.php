<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'link_github',
        'theme_id',
    ];

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function team()
    {
        return $this->hasOne(Team::class);
    }
}
