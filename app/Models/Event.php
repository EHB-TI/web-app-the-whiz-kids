<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    protected $fillable = [
        'created_by_id',
        'updated_by_id',
        'name',
        'title_color',
        'display_title',
        'desc_long',
        'desc_short',
        'img_path',
        'url_event',
        'event_date_start',
        'event_date_end'
    ];

    public function groups() {
        return $this->belongsToMany('App\Models\Group');
    }
}
