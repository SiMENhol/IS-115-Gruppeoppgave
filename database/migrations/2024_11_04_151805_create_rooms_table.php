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
        Schema::create('room', function (Blueprint $table) {
            $table->id('roomId');
            $table->string('roomType');
            $table->integer('places');
            $table->integer('roomStatus');
            $table->longText('roomDesc');
            $table->integer('price');
            $table->timestamps();
        });

        Schema::create('reservation', function (Blueprint $table) {
            $table->id('reservationId');
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('roomId');
            $table->dateTime('checkInDato');
            $table->dateTime('checkOutDato');
            $table->string('reservationStatus');
            $table->timestamps();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('roomId')->references('roomId')->on('room')->onDelete('cascade');
        });
    }


    public function down(): void
        {
            Schema::table('reservation', function (Blueprint $table) {
                $table->dropForeign(['roomId']);
            });
            Schema::table('reservation', function (Blueprint $table) {
                $table->dropForeign(['userId']);
            });
        Schema::dropIfExists('reservation');
        Schema::dropIfExists('room');

    }
};
