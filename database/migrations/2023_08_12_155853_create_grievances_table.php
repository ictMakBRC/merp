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
        Schema::create('grievances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id')->nullable()->index('grievances_employee_id_foreign');
            $table->string('emp_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable()->index('grievances_department_id_foreign');
            $table->string('grievance_type');
            $table->string('subject');
            $table->string('support_file')->nullable();
            $table->string('status');
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('grievances');
    }
};
