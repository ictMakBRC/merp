<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvStocklevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_stocklevels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inv_items_id')->nullable()->references('id')->on('inv_department__items')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('department_id')->nullable()->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->float('stock_qty')->default('0');
            $table->string('batch_no')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('stock_code')->nullable();
            $table->double('unit_cost ,60,2')->nullable();
            $table->double('total_cost ,60,2')->nullable();
            $table->foreignId('inv_supplier_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('inv_store_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('grn')->nullable();
            $table->string('delivery_no')->nullable();
            $table->string('lpo')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->integer('is_active')->default(0);
            $table->date('date_added')->nullable();
            $table->string('stock_year')->nullable();
            $table->string('stock_month')->nullable();
            $table->string('stock_week')->nullable();

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
        Schema::dropIfExists('inv_stocklevels');
    }
}
