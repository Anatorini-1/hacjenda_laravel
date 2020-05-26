<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActiveOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('offer_id')->unsigned()->references('id')->on('offers');;
            $table->biginteger('employer_id')->unsigned()->references('id')->on('users');;
            $table->biginteger('employee_id')->unsigned()->references('id')->on('users');;
            $table->dateTime('accepted_at');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employer_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('active_offers');
    }
}
