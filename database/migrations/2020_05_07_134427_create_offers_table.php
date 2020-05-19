<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string("miasto");
            $table->string("adres");
            $table->float("okres_czasu");
            $table->date("do_kiedy");
            $table->integer('cena');
            $table->string('clickbait', 100)->nullable()->default('default.png');
            $table->string('uwagi', 250)->nullable()->default('');
            $table->integer("powierzchnia");
            $table->boolean('zlecenie_stale')->nullable()->default(false);
            $table->string('czestotliwosc', 100)->nullable();
            $table->softDeletes();
            $table->json('jobs');
            $table->enum('stan', ['otwarta', 'w_realizacji','zakonczona','anulowana'])->nullable()->default('otwarta');
            $table->integer('user_id')->unsigned()->references('id')->on('users');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
