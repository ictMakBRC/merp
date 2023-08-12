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
        Schema::table('asset_maintenance_info', function (Blueprint $table) {
            $table->foreign(['authorised_by'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['issue_ref'])->references(['reference'])->on('asset_issues')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['vendor'])->references(['id'])->on('vendors')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['internal_vendor'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_maintenance_info', function (Blueprint $table) {
            $table->dropForeign('asset_maintenance_info_authorised_by_foreign');
            $table->dropForeign('asset_maintenance_info_issue_ref_foreign');
            $table->dropForeign('asset_maintenance_info_vendor_foreign');
            $table->dropForeign('asset_maintenance_info_internal_vendor_foreign');
        });
    }
};
