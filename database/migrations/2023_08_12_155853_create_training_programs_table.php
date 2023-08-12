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
        Schema::create('training_programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id')->nullable()->index('training_programs_employee_id_foreign');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('organised_by');
            $table->string('training_name');
            $table->string('training_length');
            $table->longText('training_description')->nullable();
            $table->string('certificate')->nullable();
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
        Schema::dropIfExists('training_programs');
    }
};
