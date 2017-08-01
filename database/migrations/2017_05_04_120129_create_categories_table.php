<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('categories', function(Blueprint $table) {

      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->string('name');
      $table->unsignedInteger('parent_id')->nullable()->index();;
      $table->unsignedInteger('lft')->index();
      $table->unsignedInteger('rgt')->index();
      $table->unsignedInteger('depth')->default(0);
      $table->integer('order_id');
      $table->integer('user_id')->unsigned()->nullable();
      $table->string('slug', 255);
      $table->text('full_name');
      $table->text('counter');
      $table->tinyInteger('custom_fees');
      $table->tinyInteger('enable_auctions')->default('1');
      $table->tinyInteger('enable_wanted');
      $table->text('logo_path');
      $table->string('meta_title', 500);
      $table->text('meta_description');
      $table->index('user_id', 'user_id');
      $table->index(['parent_id', 'order_id', 'name'], 'parent_id_order_id_name');
      $table->index('enable_auctions', 'enable_auctions');
      $table->index(['user_id', 'parent_id'], 'user_id_parent_id');
      $table->timestamps();
      
      $table->unique(['parent_id', 'name']);
      $table->foreign('user_id')
          ->references('id')->on('users')
          ->onDelete('cascade');
      $table->foreign('parent_id')
          ->references('id')->on('categories')
          ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('categories');
  }

}
