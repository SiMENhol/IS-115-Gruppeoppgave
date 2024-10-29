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
        Schema::create('rom', function (Blueprint $table) {
            $table->id('romId');
            $table->string('romType');
            $table->integer('antallSenger');
            $table->integer('romStatus');
            $table->longText('romBeskrivelse');
            $table->integer('prisPrNatt');
            $table->timestamps();
        });

        Schema::create('reservasjon', function (Blueprint $table) {
            $table->id('reservasjonId');
            $table->unsignedBigInteger('brukerId');
            $table->unsignedBigInteger('romId');
            $table->dateTime('checkInDato');
            $table->dateTime('checkOutDato');
            $table->string('reservasjonStatus');
            $table->timestamps();
            $table->foreign('brukerId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('romId')->references('romId')->on('rom')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
        {
            Schema::table('reservasjon', function (Blueprint $table) {
                $table->dropForeign(['romId']);
            });
            Schema::table('reservasjon', function (Blueprint $table) {
                $table->dropForeign(['brukerId']);
            });
        Schema::dropIfExists('reservasjon');
        Schema::dropIfExists('rom');

    }
};
