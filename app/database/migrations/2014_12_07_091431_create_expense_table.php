<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
	{
		Schema::create('expense',function(Blueprint $table)
        {
			$table->increments('id');
            $table->integer('amount')->unsigned();
            $table->integer('merchant_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->text('notes');
            $table->integer('attachment_id')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('vocabulary');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('expense');
	}

}
