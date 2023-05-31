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
        Schema::table('inv_requests', function (Blueprint $table) {
            $table->foreignId('acknowledged_by')->nullable()->references('id')->on('users');
            $table->string('acknowledgement')->nullable();
        });



        Schema::table('inv_stock_document_items', function (Blueprint $table1) {
            $table1->foreignId('department_id')->nullable()->references('id')->on('departments')->after('item_id');
            $table1->decimal('qyt_given',20,2)->nullable()->default(0.00)->after('stock_qty');
            $table1->decimal('qyt_remaining',20,2)->nullable()->default(0.00)->after('stock_qty');
        });


        Schema::table('inv_stock_documents', function (Blueprint $table2) {
            $table2->foreignId('acknowledged_by')->nullable()->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inv_requests', function (Blueprint $table) {
            //
        });
    }
};
