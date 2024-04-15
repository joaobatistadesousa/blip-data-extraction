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
        /*
        create table sentMessage(
id int auto_increment primary key,
idSmartContact int,
start_date datetime,
end_date datetime,
count int,
 FOREIGN KEY (idSmartContact) REFERENCES smartContact(id)


);

       */
      Schema::create('sentMessage', function (Blueprint $table) {
          $table->id();
          $table->integer('idSmartContact');
          $table->dateTime('start_date');
          $table->dateTime('end_date');
          $table->integer('count');
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sentMessage');
    }
};
