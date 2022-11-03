<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeWarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_warnings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('emp_id')->nullable();
            $table->foreignId('department_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('reason')->nullable();
            $table->string('letter');
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
        Schema::dropIfExists('employee_warnings');
    }
}
