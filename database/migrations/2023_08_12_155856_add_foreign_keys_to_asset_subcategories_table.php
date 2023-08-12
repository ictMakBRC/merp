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
        Schema::table('asset_subcategories', function (Blueprint $table) {
            $table->foreign(['asset_category_id'])->references(['id'])->on('asset_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_subcategories', function (Blueprint $table) {
            $table->dropForeign('asset_subcategories_asset_category_id_foreign');
        });
    }
};
