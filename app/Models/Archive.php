<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'category', 'images', 'event_date'];

    // Ini memberitahu Laravel bahwa 'images' adalah array
    protected $casts = [
        'images' => 'array',
    ];
}