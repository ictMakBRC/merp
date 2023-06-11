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
        Schema::table('employees', function (Blueprint $table) {
            $table->float('salary_usd',60,2)->default(0)->after('nssf_number');
            $table->float('salary_ugx',60,2)->default(0)->after('nssf_number');
            $table->string('currency',50)->default('USD')->after('nssf_number');
            $table->foreignId('active_bank_account')->nullable()->after('nssf_number')->references('id')->on('banking_information');
        });

        Schema::table('banking_information', function (Blueprint $table1) {
            $table1->integer('is_default')->default(0)->after('account_number');
        });

        Schema::table('official_contracts', function (Blueprint $table2) {
            $table2->string('currency',50)->default('UGX')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
};
