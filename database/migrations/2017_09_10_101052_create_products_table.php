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
            $table->increments('id');
            $table->string('product_name');
            $table->string('model_no')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->boolean('has_serial');
            $table->string('product_unit');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->boolean('publication_status')->default(TRUE);
            $table->softDeletes();
            $table->timestamps();
//
//            $table->foreign('category_id')
//                    ->references('id')
//                    ->on('product_categories')
//                    ->onDelete('cascade');
//            $table->foreign('brand_id')
//                    ->references('id')
//                    ->on('product_brands')
//                    ->onDelete('cascade');
//            $table->primary(['brand_id', 'category_id']);
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
