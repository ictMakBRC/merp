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
        Schema::create('dm_request_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->default(0);        
            $table->foreignId('document_category_id')->references('id')->on('dm_document_categories');
            $table->string('title');
            $table->string('original_file');
            $table->string('signed_file');
            $table->string('request_code')->unique();
            $table->string('request_id')->nullable()->references('id')->on('dm_document_requests')->onDelete('restrict')->onUpdate('cascade');
            $table->boolean('is_active')->default(1);
            $table->string('status')->default('Pending');
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
        Schema::dropIfExists('dm_request_documents');
    }
};
