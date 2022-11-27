<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvStockSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_stock_settlements', function (Blueprint $table) {
            $table->id();
            $table->string('request_code')->nullable();
            $table->foreignId('department_id')->nullable()->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('borrower_id')->nullable()->references('id')->on('departments')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('qty_given')->nullable();
            $table->foreignId('qty_remaining')->nullable();
            $table->date('date_added')->nullable();
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
        Schema::dropIfExists('inv_stock_settlements');
    }
}
