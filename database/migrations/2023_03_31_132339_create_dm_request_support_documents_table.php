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
        Schema::create('dm_request_support_documents', function (Blueprint $table) {
            $table->id();     
            $table->foreignId('parent_id')->references('id')->on('dm_request_documents')->onDelete('restrict')->onUpdate('cascade');
            $table->string('title');
            $table->string('original_file');
            $table->string('document_code')->unique();
            $table->foreignId('request_id')->nullable()->references('id')->on('dm_document_requests')->onDelete('restrict')->onUpdate('cascade');
            $table->boolean('is_active')->default(1);
            $table->integer('download_count')->default(0);
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
        Schema::dropIfExists('dm_request_support_documents');
    }
};
