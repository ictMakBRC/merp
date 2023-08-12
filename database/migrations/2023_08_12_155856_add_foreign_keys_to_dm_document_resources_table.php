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
        Schema::table('dm_document_resources', function (Blueprint $table) {
            $table->foreign(['created_by'])->references(['id'])->on('users')->onUpdate('CASCADE');
            $table->foreign(['department_id'])->references(['id'])->on('departments')->onUpdate('CASCADE');
            $table->foreign(['resource_category_id'])->references(['id'])->on('dm_document_resource_categories')->onUpdate('CASCADE');
            $table->foreign(['reviewed_by'])->references(['id'])->on('users')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dm_document_resources', function (Blueprint $table) {
            $table->dropForeign('dm_document_resources_created_by_foreign');
            $table->dropForeign('dm_document_resources_department_id_foreign');
            $table->dropForeign('dm_document_resources_resource_category_id_foreign');
            $table->dropForeign('dm_document_resources_reviewed_by_foreign');
        });
    }
};
