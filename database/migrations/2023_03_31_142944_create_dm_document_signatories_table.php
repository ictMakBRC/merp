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
        Schema::create('dm_document_signatories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->nullable()->references('id')->on('dm_request_documents')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('signatory_id')->nullable()->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('signatory_level')->default(1);
            $table->string('title')->nullable();
            $table->text('summary')->nullable();
            $table->string('signatory_status')->default('Pending');
            $table->integer('is_active')->default(0);
            $table->integer('acknowledgement')->default(0);
            $table->string('signature')->unique();
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('dm_document_signatories');
    }
};
