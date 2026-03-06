<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('site_settings', function ($table) {
        $table->id();
        $table->string('hero_title')->default('Selamat Datang di UKKOM');
        $table->text('hero_subtitle')->nullable();
        $table->string('hero_image')->nullable();
        $table->text('quote_text')->nullable();
        $table->string('quote_author')->nullable();
        $table->text('address')->nullable();
        $table->string('instagram_link')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
