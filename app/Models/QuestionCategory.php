<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function questions() {
        return $this->hasMany('\App\Models\Question');
    }
}
