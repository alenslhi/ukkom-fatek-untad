<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model
{
    protected $fillable = ['name', 'position', 'quote', 'image', 'ig_link', 'tiktok_link'];
}
