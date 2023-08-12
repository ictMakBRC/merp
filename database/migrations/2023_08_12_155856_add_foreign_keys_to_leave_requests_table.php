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
        Schema::table('leave_requests', function (Blueprint $table) {
            $table->foreign(['employee_id'])->references(['id'])->on('employees')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['leave_id'])->references(['id'])->on('leaves')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['department_id'])->references(['id'])->on('departments')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_requests', function (Blueprint $table) {
            $table->dropForeign('leave_requests_employee_id_foreign');
            $table->dropForeign('leave_requests_leave_id_foreign');
            $table->dropForeign('leave_requests_department_id_foreign');
        });
    }
};
