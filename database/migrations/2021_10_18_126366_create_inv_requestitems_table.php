<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvRequestitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_requestitems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inv_requests_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('inv_items_id')->nullable()->references('id')->on('inv_department__items')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('inv_item_id')->nullable()->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->float('request_qty')->default('0');
            $table->float('qty_given')->default('0');
            $table->string('request_code')->nullable();
            $table->integer('is_active')->default('0');
            $table->string('item_state')->default('open');
            $table->foreignId('users_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('inv_requestitems');
    }
}
