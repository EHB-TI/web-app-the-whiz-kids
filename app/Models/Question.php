<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function category() {
        return $this->belongsTo('App\Models\QuestionCategory', 'question_category_id', 'id');
    }
}
