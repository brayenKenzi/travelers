<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //cara membuat table: php artisan make:migration create_transactions_table --create=ransactions
    //cara memindahkan ke phpmyadmin MYSQL : php artisan migrate
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('travel_package_id');
            $table->integer('users_id')->nullable();
            $table->integer('additional_visa');
            $table->integer('transaction_total');
            $table->string('transaction_status'); 
            //IN_CART, PENDING, SUCCESS, CANCEL, FAILED
            $table->softDeletes();
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
        Schema::dropIfExists('transactions');
    }
}
