<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('product_author');
            $table->string('product_title');
            $table->text('product_content')->nullable();
            $table->string('product_slug');
            $table->integer('product_featured');
            $table->string('product_type');
            $table->string('product_price')->nullable();
            $table->string('product_old_price')->nullable();
            $table->string('product_price_percent')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_unit')->nullable();
            $table->integer('product_stock')->nullable();
            $table->integer('updated_at');
            $table->integer('created_at');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
