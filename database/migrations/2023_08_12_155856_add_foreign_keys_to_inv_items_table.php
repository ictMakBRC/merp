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
        Schema::table('inv_items', function (Blueprint $table) {
            $table->foreign(['inv_store_id'])->references(['id'])->on('inv_stores')->onUpdate('CASCADE');
            $table->foreign(['inv_subunit_id'])->references(['id'])->on('inv_subunits');
            $table->foreign(['inv_uom_id'])->references(['id'])->on('inv_uoms')->onUpdate('CASCADE');
            $table->foreign(['supplier_id'])->references(['id'])->on('suppliers')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inv_items', function (Blueprint $table) {
            $table->dropForeign('inv_items_inv_store_id_foreign');
            $table->dropForeign('inv_items_inv_subunit_id_foreign');
            $table->dropForeign('inv_items_inv_uom_id_foreign');
            $table->dropForeign('inv_items_supplier_id_foreign');
        });
    }
};
