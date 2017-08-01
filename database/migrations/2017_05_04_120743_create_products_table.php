<?php

use Illuminate\Support\Facades\Schema;
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

            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->enum('listing_type', ['auction', 'product', 'wanted', 'reverse', 'first_bidder'])->default('auction');
            $table->string('name', 255);
            $table->string('subtitle', 255);
            $table->string('search_tags', 255);
            $table->text('description');
            $table->string('item_condition', 255);
            $table->integer('user_id')->unsigned();
            $table->enum('list_in', ['site', 'store', 'both'])->default('site');
            $table->integer('addl_category_id')->unsigned()->nullable();
            $table->string('currency', 50);
            $table->integer('quantity');
            $table->decimal('start_price', 16, 2);
            $table->decimal('reserve_price', 16, 2);
            $table->decimal('buyout_price', 16, 2);
            $table->tinyInteger('enable_make_offer');
            $table->decimal('make_offer_min', 16, 2);
            $table->decimal('make_offer_max', 16, 2);
            $table->tinyInteger('apply_tax');
            $table->decimal('bid_increment', 16, 2);
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->integer('duration')->nullable();
            $table->tinyInteger('hpfeat');
            $table->tinyInteger('catfeat');
            $table->tinyInteger('bold');
            $table->tinyInteger('highlighted');
            $table->tinyInteger('private_auction');
            $table->tinyInteger('disable_sniping');
            $table->integer('nb_relists');
            $table->tinyInteger('auto_relist_sold');
            $table->tinyInteger('is_relisted');
            $table->integer('country')->unsigned()->nullable();
            $table->string('state', 255);
            $table->string('address', 255);
            $table->text('postage_settings');
            $table->text('offline_payment');
            $table->text('direct_payment');
            $table->string('voucher_code', 255);
            $table->tinyInteger('active');
            $table->tinyInteger('approved');
            $table->tinyInteger('closed');
            $table->tinyInteger('deleted');
            $table->tinyInteger('draft');
            $table->integer('nb_clicks');
            $table->text('rollback_data');
            $table->dateTime('counted_at')->nullable();
            $table->enum('last_count_operation', ['none', 'add', 'subtract'])->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id', 'user_id');
            $table->index('category_id', 'category_id');
            $table->index('addl_category_id', 'addl_category_id');
            $table->index(['active', 'approved', 'closed', 'deleted', 'draft'], 'active_approved_closed_deleted_draft');
            $table->index('country', 'country');
            $table->index('listing_type', 'listing_type');
            $table->index('counted_at', 'counted_at');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('addl_category_id')
                ->references('id')->on('categories')
                ->onDelete('set null');
            $table->foreign('country')
                ->references('id')->on('locations')
                ->onDelete('set null');
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('products');
    }
}
