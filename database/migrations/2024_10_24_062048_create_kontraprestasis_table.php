<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kontraprestasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('events_id')->index(); // FK ke events
            $table->unsignedBigInteger('icon_photo_kontraprestasis_id')->nullable()->index(); // FK opsional
            $table->unsignedBigInteger('kontraprestasi_tier_id')->index(); // FK ke tier
            $table->timestamps();

            // Foreign keys
            $table->foreign('events_id')
                  ->references('id')->on('events')->onDelete('cascade');

            $table->foreign('icon_photo_kontraprestasis_id')
                  ->references('id')->on('icon_photo_kontraprestasis')->onDelete('set null');

            $table->foreign('kontraprestasi_tier_id')
                  ->references('id')->on('kontraprestasi_tiers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kontraprestasis');
    }
};
