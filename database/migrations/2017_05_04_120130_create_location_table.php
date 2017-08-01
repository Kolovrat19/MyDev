<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255);
            $table->text('full_name');
            $table->string('iso_code', 20);
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('order_id');
            $table->timestamps();

            $table->index(['parent_id', 'order_id', 'name'], 'parent_id_order_id_name');

            $table->foreign('parent_id')
                ->references('id')->on('locations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
