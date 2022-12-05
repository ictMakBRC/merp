<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name')->nullable();
            $table->foreignId('inv_subunit_id')->nullable()->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->float('cost_price ,60,2')->default('0');
            $table->foreignId('inv_uom_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('supplier_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->float('max_qty')->default('0');
            $table->float('min_qty')->default('0');
            $table->foreignId('inv_store_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('description')->nullable();
            $table->date('date_added')->nullable();
            $table->integer('is_active')->default(1);
            $table->string('expires')->default('No');
            $table->string('item_code')->nullable()->unique();
            $table->foreignId('user_id')->default('1');
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
}
