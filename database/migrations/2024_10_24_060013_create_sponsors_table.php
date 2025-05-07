<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        schema::create('sponsors', function(blueprint $table){
            $table->id();
            $table->unsignedBigInteger('event_id')->index();
            $table->unsignedBigInteger('entrepreneur_id')->index();
            $table->integer('amount');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsors');
    }
};
