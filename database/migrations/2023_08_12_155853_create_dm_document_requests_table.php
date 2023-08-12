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
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('request_code')->unique();
            $table->unsignedBigInteger('request_category')->index('dm_document_requests_request_category_foreign');
            $table->boolean('is_active')->default(true);
            $table->string('status')->default('Pending');
            $table->string('priority')->default('Normal');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->index('dm_document_requests_created_by_foreign');
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
