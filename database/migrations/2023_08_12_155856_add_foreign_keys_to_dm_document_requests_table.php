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
        Schema::table('dm_document_requests', function (Blueprint $table) {
            $table->foreign(['created_by'])->references(['id'])->on('users')->onUpdate('CASCADE');
            $table->foreign(['request_category'])->references(['id'])->on('dm_document_categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dm_document_requests', function (Blueprint $table) {
            $table->dropForeign('dm_document_requests_created_by_foreign');
            $table->dropForeign('dm_document_requests_request_category_foreign');
        });
    }
};
