<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionMainItemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('distribution_main_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('distribution_id');
            $table->integer('product_id');
            $table->double('quantity');
            $table->text('serial')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('distribution_main_items');
    }

}
