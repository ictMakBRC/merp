<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('unit_name');
            $table->string('belongs_to');
            $table->string('description')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('department_units');
    }
}
