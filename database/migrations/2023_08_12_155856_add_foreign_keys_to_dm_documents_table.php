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
        Schema::table('dm_documents', function (Blueprint $table) {
            $table->foreign(['created_by'])->references(['id'])->on('users')->onUpdate('CASCADE');
            $table->foreign(['document_category_id'])->references(['id'])->on('dm_document_categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dm_documents', function (Blueprint $table) {
            $table->dropForeign('dm_documents_created_by_foreign');
            $table->dropForeign('dm_documents_document_category_id_foreign');
        });
    }
};
