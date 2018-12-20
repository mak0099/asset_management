<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandApprovalsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('demand_approvals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('demand_id');
            $table->string('issue_no');
            $table->date('issue_date');
            $table->string('file_name')->nullable();
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
        Schema::dropIfExists('demand_approvals');
    }

}
