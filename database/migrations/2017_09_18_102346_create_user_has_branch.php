<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserHasBranch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_branch', function (Blueprint $table) {
            $table->integer('branch_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('branch_id')
                    ->references('id')
                    ->on('units')
                    ->onDelete('cascade');

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->primary(['branch_id', 'user_id']);
        });
        
        $user = \App\User::first();
        $unit = \App\Unit::insert([
            'unit_name' => 'Main Unit',
            'area_code' => '0000',
            'email' => 'something@example.com',
            'unit_type' => 'Main Unit',
            'created_by' => $user->id,
        ]);
        $user->setBranch($unit);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_branch');
    }
}
