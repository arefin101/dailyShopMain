<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('customerId');
            $table->string('userName')->unique();
            $table->foreign('userName')->cascadeOnDelete()->references('userName')->on('users');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('DOB');
            $table->string('gender');
            $table->string('address');
            $table->string('district');
            $table->string('userType');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
