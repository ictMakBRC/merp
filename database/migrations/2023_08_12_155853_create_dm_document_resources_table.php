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
        Schema::create('dm_document_resources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('resource_category_id')->index('dm_document_resources_resource_category_id_foreign');
            $table->unsignedBigInteger('department_id')->index('dm_document_resources_department_id_foreign');
            $table->string('title');
            $table->string('version')->nullable();
            $table->string('code')->unique();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->string('file');
            $table->string('details')->nullable();
            $table->json('accessed_by')->nullable();
            $table->json('assossiated_by')->nullable();
            $table->integer('expires')->default(0);
            $table->integer('private')->default(0);
            $table->date('expiry_date')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('created_by')->nullable()->index('dm_document_resources_created_by_foreign');
            $table->unsignedBigInteger('reviewed_by')->nullable()->index('dm_document_resources_reviewed_by_foreign');
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
        Schema::dropIfExists('dm_document_resources');
    }
};
