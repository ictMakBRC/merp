<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvDepartmentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_department__items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->nullable()->references('id')->on('departments')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('inv_item_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->integer('brand')->nullable();
            $table->boolean('is_active')->default(1);
            $table->float('qty_left')->default('0');
            $table->float('qty_held')->default('0');
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
        Schema::dropIfExists('inv_department__items');
    }
}
