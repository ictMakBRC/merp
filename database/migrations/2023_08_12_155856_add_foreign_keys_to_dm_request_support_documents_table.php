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
        Schema::table('dm_request_support_documents', function (Blueprint $table) {
            $table->foreign(['created_by'])->references(['id'])->on('users')->onUpdate('CASCADE');
            $table->foreign(['parent_id'])->references(['id'])->on('dm_request_documents')->onUpdate('CASCADE');
            $table->foreign(['request_id'])->references(['id'])->on('dm_document_requests')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dm_request_support_documents', function (Blueprint $table) {
            $table->dropForeign('dm_request_support_documents_created_by_foreign');
            $table->dropForeign('dm_request_support_documents_parent_id_foreign');
            $table->dropForeign('dm_request_support_documents_request_id_foreign');
        });
    }
};
