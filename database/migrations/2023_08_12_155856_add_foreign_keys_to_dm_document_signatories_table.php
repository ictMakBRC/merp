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
        Schema::table('dm_document_signatories', function (Blueprint $table) {
            $table->foreign(['document_id'])->references(['id'])->on('dm_request_documents')->onUpdate('CASCADE');
            $table->foreign(['signatory_id'])->references(['id'])->on('users')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dm_document_signatories', function (Blueprint $table) {
            $table->dropForeign('dm_document_signatories_document_id_foreign');
            $table->dropForeign('dm_document_signatories_signatory_id_foreign');
        });
    }
};
