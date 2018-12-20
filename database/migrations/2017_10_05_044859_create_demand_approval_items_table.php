<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandApprovalItemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('demand_approval_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('demand_approval_id')->unsigned();
            $table->integer('product_id');
            $table->integer('quantity');
            $table->softDeletes();
            $table->timestamps();
            

            $table->foreign('demand_approval_id')
                    ->references('id')
                    ->on('demand_approvals')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('demand_approval_items');
    }

}
