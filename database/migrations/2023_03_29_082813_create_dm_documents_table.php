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
        Schema::create('dm_documents', function (Blueprint $table) {
            $table->id();   
            $table->unsignedBigInteger('parent_id')->default(0);        
            $table->foreignId('document_category_id')->references('id')->on('dm_document_categories');
            $table->string('title');
            $table->string('file');
            $table->string('document_code')->unique();
            $table->string('mulitple_identifier')->nullable();
            $table->date('expiry_date')->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('status')->default('Pending');
            $table->string('priority')->default('Normal');
            $table->text('details')->nullable();
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
        Schema::dropIfExists('dm_documents');
    }
};
