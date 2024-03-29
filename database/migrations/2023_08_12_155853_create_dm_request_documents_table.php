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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->unsignedBigInteger('document_category_id')->index('dm_request_documents_document_category_id_foreign');
            $table->string('document_code');
            $table->string('title');
            $table->string('original_file');
            $table->string('signed_file')->nullable();
            $table->string('request_code')->unique();
            $table->string('request_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('status')->default('Pending');
            $table->integer('download_count')->default(0);
            $table->unsignedBigInteger('created_by')->nullable()->index('dm_request_documents_created_by_foreign');
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
