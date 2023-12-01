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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('turn_id');
            $table->unsignedBigInteger('homeTeam_id');
            $table->unsignedBigInteger('awayTeam_id');
            $table->unsignedBigInteger('homePlayer1_id')->nullable();
            $table->unsignedBigInteger('awayPlayer1_id')->nullable();
            $table->tinyInteger('homePlayer1Point')->nullable();
            $table->tinyInteger('awayPlayer1Point')->nullable();
            $table->unsignedBigInteger('homePlayer2_id')->nullable();
            $table->unsignedBigInteger('awayPlayer2_id')->nullable();
            $table->tinyInteger('homePlayer2Point')->nullable();
            $table->tinyInteger('awayPlayer2Point')->nullable();
            $table->unsignedBigInteger('homePPlayer1_id')->nullable();
            $table->unsignedBigInteger('homePPlayer2_id')->nullable();
            $table->unsignedBigInteger('awayPPlayer1_id')->nullable();
            $table->unsignedBigInteger('awayPPlayer2_id')->nullable();
            $table->tinyInteger('homePPlayerPoint')->nullable();
            $table->tinyInteger('awayPPlayerPoint')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
