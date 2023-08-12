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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('usd_rate', 8, 2)->nullable()->default(3650);
            $table->integer('eur_rate')->default(0);
            $table->integer('gbp_rate')->default(0);
            $table->double('employee_nssf', 8, 2)->nullable()->default(5);
            $table->double('employer_nssf', 8, 2)->nullable()->default(10);
            $table->double('paye', 8, 2)->nullable()->default(30);
            $table->double('vat', 8, 2)->nullable()->default(18);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->integer('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
};
