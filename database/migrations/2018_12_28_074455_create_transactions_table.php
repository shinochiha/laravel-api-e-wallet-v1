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
            $table->integer('user_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->decimal('amount');
            $table->string('note');
            $table->date('date');
            $table->string('user');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users'); 

            $table->foreign('type_id')
                  ->references('type_id')
                  ->on('types');    

            $table->foreign('category_id')
                  ->references('category_id')
                  ->on('categories');

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
