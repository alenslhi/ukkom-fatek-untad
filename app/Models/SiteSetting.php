<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    protected $fillable = ['hero_title', 'hero_subtitle', 'hero_image', 'quote_text', 'quote_author', 'address', 'instagram_link'];
}