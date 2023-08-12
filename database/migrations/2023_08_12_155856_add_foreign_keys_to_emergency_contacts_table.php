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
        Schema::table('emergency_contacts', function (Blueprint $table) {
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
        Schema::table('emergency_contacts', function (Blueprint $table) {
            $table->dropForeign('emergency_contacts_employee_id_foreign');
        });
    }
};
