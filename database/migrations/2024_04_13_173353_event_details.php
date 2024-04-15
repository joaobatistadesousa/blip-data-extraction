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
         * create table event_details(
id int auto_increment primary key,
idSmartContact int,
category varchar(255),
action varchar(255),
storageDate dateTime,
count int,
 FOREIGN KEY (idSmartContact) REFERENCES smartContact(id)

         */
        Schema::create('event_details', function (Blueprint $table) {
            $table->id();
            $table->integer('idSmartContact');
            $table->string('category');
            $table->string('action');
            $table->dateTime('storageDate');
            $table->integer('count');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_details');

    }
};
