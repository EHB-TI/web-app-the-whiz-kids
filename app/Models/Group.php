<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function users() {
        return $this->hasMany('\App\Models\User');
    }

    public function events() {
        return $this->belongsToMany('\App\Models\Event');
    }
}
