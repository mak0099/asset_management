<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('committee_no');
            $table->date('procurement_date');
            $table->integer('product_id');
            $table->string('serial')->nullable();
            $table->string('quantity');
            $table->string('price');
            $table->boolean('is_consumable');
            $table->boolean('is_usable');
            $table->boolean('in_stock')->default(TRUE);
            $table->date('date');
            $table->integer('stock_owner');
            $table->string('file_name')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->boolean('publication_status')->default(TRUE);
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
        Schema::dropIfExists('stocks');
    }
}
