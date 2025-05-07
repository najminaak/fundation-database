<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kontraprestasi_tiers', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->integer('min_sponsor');
            $table->integer('max_sponsor');
            $table->string('feedback', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kontraprestasi_tiers');
    }
};
