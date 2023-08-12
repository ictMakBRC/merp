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
        Schema::create('inv_stock_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->nullable()->constrained()->onUpdate('restrict')->onDelete('restrict');     
            $table->string('stock_code')->nullable();
            $table->string('grn')->nullable();
            $table->string('delivery_no')->nullable();
            $table->string('lpo')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->boolean('is_active')->default(0);
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
        Schema::dropIfExists('inv_stock_documents');
    }
};
