<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devotionals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('bible_text');
            $table->text('content');
            $table->text('prayer');
            $table->text('further_study');
            $table->text('am_scriptures');
            $table->text('pm_scriptures');
            $table->string('audio_path')->nullable();  // Nullable for optional files
            $table->string('image_url')->nullable();   // Nullable and changed to string
            $table->date('custom_date')->nullable(); // Add a custom date field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devotionals');
    }
};
