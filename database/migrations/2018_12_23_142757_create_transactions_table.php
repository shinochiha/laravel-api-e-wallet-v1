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
            $table->enum('type', [0, 1, 2]);
            $table->integer('category_id')->unsigned()->index();
            $table->decimal('amount');
            $table->string('note');
            $table->date('date');
            $table->string('user');

            $table->foreign('category_id')
                  ->references('category_id')
                  ->on('categories');

            $table->foreign('user_id')
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
