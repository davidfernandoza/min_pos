<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
						$table->bigIncrements('id')->unsigned();
						$table->unsignedBigInteger('category_id');
						$table->string('name');
						$table->integer('amount');
						$table->double('price', 11, 5);
						$table->text('description');
						$table->timestamps();
						$table->softDeletes();

						$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
