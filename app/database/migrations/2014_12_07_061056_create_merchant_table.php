<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
public function up()
	{
		Schema::create('merchant',function(Blueprint $table)
        {
			$table->increments('id');
            $table->string('name', 60)->unique();
            $table->integer('category_id')->nullable();
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
		Schema::dropIfExists('merchant');
	}

}
