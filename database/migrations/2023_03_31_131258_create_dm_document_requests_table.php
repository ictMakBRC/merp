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
        Schema::create('dm_document_requests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('request_code')->unique();
            $table->foreignId('request_category')->references('id')->on('dm_document_categories');
            $table->boolean('is_active')->default(1);
            $table->string('status')->default('Pending');
            $table->string('priority')->default('Normal');
            $table->text('description')->nullable();
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('dm_document_requests');
    }
};
