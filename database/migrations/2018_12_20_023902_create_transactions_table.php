<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('transaction_id');
            $table->enum('type', ['income','expense']);
            $table->enum('category', ['family', 'sport', 'loan']);
            $table->string('amount');
            $table->string('note');
            $table->date('date');
            $table->string('user');
            $table->integer('account_id')->unsigned();

            $table->foreign('account_id')
                  ->references('id')
                  ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
