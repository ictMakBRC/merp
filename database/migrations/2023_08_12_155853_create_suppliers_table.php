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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier_name')->nullable();
            $table->string('tin_number')->nullable();
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_person')->nullable();
            $table->text('goods_supplied')->nullable();
            $table->boolean('is_active')->nullable();
            $table->unsignedBigInteger('created_by')->index('suppliers_created_by_foreign');
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
        Schema::dropIfExists('suppliers');
    }
};
