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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id')->nullable()->index('leave_requests_employee_id_foreign');
            $table->string('emp_id')->nullable();
            $table->unsignedBigInteger('leave_id')->nullable()->index('leave_requests_leave_id_foreign');
            $table->unsignedBigInteger('department_id')->nullable()->index('leave_requests_department_id_foreign');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('length')->nullable();
            $table->longText('reason')->nullable();
            $table->longText('duties_delegated')->nullable();
            $table->string('status');
            $table->string('delegatee_status')->nullable();
            $table->string('confirmation')->nullable();
            $table->string('comment')->nullable();
            $table->string('delegatee_comment')->nullable();
            $table->unsignedBigInteger('delegated_to')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedBigInteger('accepted_by')->nullable();
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
        Schema::dropIfExists('leave_requests');
    }
};
