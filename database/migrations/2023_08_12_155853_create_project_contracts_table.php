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
        Schema::create('project_contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id')->nullable()->index('project_contracts_employee_id_foreign');
            $table->unsignedBigInteger('position_id')->index('project_contracts_position_id_foreign');
            $table->unsignedBigInteger('project_id')->index('project_contracts_project_id_foreign');
            $table->string('contract_name');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->double('fte', 12, 2)->nullable();
            $table->double('gross_salary', 12, 2)->nullable();
            $table->string('contract_file');
            $table->string('status')->default('Running');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->string('currency', 80)->default('UGX');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_contracts');
    }
};
