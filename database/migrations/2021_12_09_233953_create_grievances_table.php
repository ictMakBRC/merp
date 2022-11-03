<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrievancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grievances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('emp_id')->nullable();
            $table->foreignId('department_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
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
}
