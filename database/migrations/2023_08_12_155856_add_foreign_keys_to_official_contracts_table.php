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
        Schema::table('official_contracts', function (Blueprint $table) {
            $table->foreign(['department_id'])->references(['id'])->on('departments')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['employee_id'])->references(['id'])->on('employees')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('official_contracts', function (Blueprint $table) {
            $table->dropForeign('official_contracts_department_id_foreign');
            $table->dropForeign('official_contracts_employee_id_foreign');
        });
    }
};
