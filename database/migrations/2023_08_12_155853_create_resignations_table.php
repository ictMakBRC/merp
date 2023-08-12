<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resignations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id')->nullable()->index('resignations_employee_id_foreign');
            $table->string('emp_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable()->index('resignations_department_id_foreign');
            $table->string('subject')->nullable();
            $table->date('hand_over_date')->nullable();
            $table->string('letter');
            $table->string('status')->nullable();
            $table->string('comment')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
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
        Schema::dropIfExists('resignations');
    }
};
