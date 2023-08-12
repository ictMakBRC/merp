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
        Schema::table('asset_issues', function (Blueprint $table) {
            $table->foreign(['asset_id'])->references(['id'])->on('assets')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['destination_dept'])->references(['id'])->on('departments')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['source_dept'])->references(['id'])->on('departments')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['station_id'])->references(['id'])->on('stations')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_issues', function (Blueprint $table) {
            $table->dropForeign('asset_issues_asset_id_foreign');
            $table->dropForeign('asset_issues_destination_dept_foreign');
            $table->dropForeign('asset_issues_source_dept_foreign');
            $table->dropForeign('asset_issues_station_id_foreign');
        });
    }
};
