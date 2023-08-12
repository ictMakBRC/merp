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
        Schema::create('leave_balances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id')->nullable()->index('leave_balances_employee_id_foreign');
            $table->string('emp_id')->nullable();
            $table->unsignedBigInteger('leave_id')->nullable()->index('leave_balances_leave_id_foreign');
            $table->integer('year')->nullable();
            $table->integer('limit')->nullable();
            $table->integer('used')->nullable();
            $table->integer('balance')->nullable();
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
        Schema::dropIfExists('leave_balances');
    }
};
