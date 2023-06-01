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
        Schema::create('dm_document_resource_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_read_only')->unique();
            $table->string('status')->default(1);
            $table->string('code')->unique();
            $table->integer('expires')->default(0);
            $table->foreignId('created_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('dm_document_resource_categories');
    }
};
