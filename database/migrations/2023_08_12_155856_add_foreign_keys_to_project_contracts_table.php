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
        Schema::table('project_contracts', function (Blueprint $table) {
            $table->foreign(['employee_id'])->references(['id'])->on('employees')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['position_id'])->references(['id'])->on('designations')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['project_id'])->references(['id'])->on('departments')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_contracts', function (Blueprint $table) {
            $table->dropForeign('project_contracts_employee_id_foreign');
            $table->dropForeign('project_contracts_position_id_foreign');
            $table->dropForeign('project_contracts_project_id_foreign');
        });
    }
};
