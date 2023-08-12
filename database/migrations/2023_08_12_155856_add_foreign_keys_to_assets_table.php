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
        Schema::table('assets', function (Blueprint $table) {
            $table->foreign(['asset_category_id'])->references(['id'])->on('asset_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['asset_subcategory_id'])->references(['id'])->on('asset_subcategories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['department_id'])->references(['id'])->on('departments')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['station_id'])->references(['id'])->on('stations')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['vendor_id'])->references(['id'])->on('vendors')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropForeign('assets_asset_category_id_foreign');
            $table->dropForeign('assets_asset_subcategory_id_foreign');
            $table->dropForeign('assets_department_id_foreign');
            $table->dropForeign('assets_station_id_foreign');
            $table->dropForeign('assets_user_id_foreign');
            $table->dropForeign('assets_vendor_id_foreign');
        });
    }
};
