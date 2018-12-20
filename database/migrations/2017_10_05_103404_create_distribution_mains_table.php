<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionMainsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('distribution_mains', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('demand_id');
            $table->date('distribution_date');
            $table->integer('employee_id');
            $table->integer('created_by');
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
        Schema::dropIfExists('distribution_mains');
    }

}
