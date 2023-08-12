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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('document_id')->nullable()->index('dm_document_signatories_document_id_foreign');
            $table->unsignedBigInteger('signatory_id')->nullable()->index('dm_document_signatories_signatory_id_foreign');
            $table->integer('signatory_level')->default(1);
            $table->string('title')->nullable();
            $table->text('summary')->nullable();
            $table->string('signatory_status')->default('Pending');
            $table->boolean('is_active')->default(false);
            $table->integer('acknowledgement')->default(0);
            $table->string('signature')->nullable()->unique();
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
