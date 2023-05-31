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
            $table->id();
            $table->foreignId('resource_category_id')->references('id')->on('dm_document_resource_categories')->onDelete('restrict')->onUpdate('cascade');
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
            $table->boolean('status')->default(1);
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('reviewed_by')->nullable()->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
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
