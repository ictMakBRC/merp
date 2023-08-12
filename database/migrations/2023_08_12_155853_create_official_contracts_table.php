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
        Schema::create('official_contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id')->nullable()->index('official_contracts_employee_id_foreign');
            $table->unsignedBigInteger('department_id')->nullable()->index('official_contracts_department_id_foreign');
            $table->string('contract_name');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->double('gross_salary', 12, 2);
            $table->string('contract_file');
            $table->string('status')->default('Running');
            $table->string('currency', 50)->default('UGX');
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
        Schema::dropIfExists('official_contracts');
    }
};
