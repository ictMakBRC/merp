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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->index('dm_request_support_documents_parent_id_foreign');
            $table->string('title');
            $table->string('original_file');
            $table->string('document_code')->unique();
            $table->unsignedBigInteger('request_id')->nullable()->index('dm_request_support_documents_request_id_foreign');
            $table->boolean('is_active')->default(true);
            $table->integer('download_count')->default(0);
            $table->unsignedBigInteger('created_by')->nullable()->index('dm_request_support_documents_created_by_foreign');
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
