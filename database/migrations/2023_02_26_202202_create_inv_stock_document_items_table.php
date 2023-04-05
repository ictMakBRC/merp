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
        Schema::create('inv_stock_document_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inv_item_id')->nullable()->references('id')->on('inv_department__items')->onUpdate('restrict')->onDelete('restrict');           
            $table->foreignId('item_id')->nullable()->references('id')->on('inv_items')->onUpdate('restrict')->onDelete('restrict');           
            $table->float('stock_qty')->default('0');
            $table->string('batch_no')->nullable();
            $table->date('expiry_date')->nullable();
            $table->date('date_added')->nullable();
            $table->string('stock_code')->references('stock_code')->on('inv_stock_documents')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('document_id')->references('id')->on('inv_stock_documents')->onUpdate('restrict')->onDelete('restrict');
            $table->double('unit_cost',60,2)->nullable();
            $table->double('total_cost',60,2)->nullable();
            $table->foreignId('inv_supplier_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('inv_store_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('grn')->nullable();
            $table->string('delivery_no')->nullable();
            $table->string('lpo')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->integer('is_active')->default(0);
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
        Schema::dropIfExists('inv_stock_document_items');
    }
};
