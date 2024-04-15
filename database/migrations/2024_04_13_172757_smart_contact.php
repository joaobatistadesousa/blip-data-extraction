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
         * create table smartContact(
id int auto_increment primary key,
botKey varchar(255) unique,
name varchar(255) unique,
clientId int,
 FOREIGN KEY (clientId) REFERENCES client(id)


);

*/
Schema::create('smartContact', function (Blueprint $table) {
    $table->id();
    $table->string('botKey')->unique();
    $table->string('name')->unique();
    $table->unsignedBigInteger('clientId');
    $table->foreign('clientId')->references('id')->on('client');
    $table->timestamps();
});

}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smartContact');
    }
};
