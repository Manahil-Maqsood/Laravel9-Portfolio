<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlide extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $guarded = [];

    // protected $fillable = [
    //     'title',
    //     'short_title',
    //     'slide_img',
    //     'video_url',
    // ];
}
