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
        /**
         * create table client(
id int auto_increment primary key,
customerName text ,
planName text

);
         */
        Schema::create('client', function (Blueprint $table) {
            $table->id();
            $table->string('customerName');
            $table->string('planName');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
