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
        Schema::create('employee_appraisals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id')->nullable()->index('employee_appraisals_employee_id_foreign');
            $table->string('emp_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable()->index('employee_appraisals_department_id_foreign');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('appraisal_file');
            $table->unsignedBigInteger('uploaded_by')->nullable();
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
        Schema::dropIfExists('employee_appraisals');
    }
};
