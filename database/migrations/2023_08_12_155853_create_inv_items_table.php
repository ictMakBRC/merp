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
        Schema::create('inv_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_name')->nullable();
            $table->unsignedBigInteger('inv_subunit_id')->nullable()->index('inv_items_inv_subunit_id_foreign');
            $table->double('cost_price ,60,2', 8, 2)->default(0);
            $table->unsignedBigInteger('inv_uom_id')->nullable()->index('inv_items_inv_uom_id_foreign');
            $table->unsignedBigInteger('supplier_id')->nullable()->index('inv_items_supplier_id_foreign');
            $table->double('max_qty', 8, 2)->default(0);
            $table->double('min_qty', 8, 2)->default(0);
            $table->unsignedBigInteger('inv_store_id')->nullable()->index('inv_items_inv_store_id_foreign');
            $table->string('description')->nullable();
            $table->date('date_added')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('expires')->default('No');
            $table->string('item_code')->nullable()->unique();
            $table->unsignedBigInteger('user_id')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_items');
    }
};
