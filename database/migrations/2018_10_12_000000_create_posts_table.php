<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_author');
            $table->text('post_content');
            $table->longText('user_form');
            $table->string('post_title');
            $table->string('post_slug');
            $table->integer('post_featured');
            $table->integer('menu_order');
            $table->string('post_type');
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
        Schema::drop('posts');
    }
}
