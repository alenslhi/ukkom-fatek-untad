<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    // Cast 'event_date' menjadi format waktu/tanggal Laravel otomatis
    protected $casts = ['event_date' => 'datetime'];
    protected $fillable = ['title', 'category', 'event_date', 'location', 'pamphlet', 'description'];
}