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
        Schema::table('assignment_history', function (Blueprint $table) {
            $table->foreign(['asset_id'])->references(['id'])->on('assets')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['from'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['to'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assignment_history', function (Blueprint $table) {
            $table->dropForeign('assignment_history_asset_id_foreign');
            $table->dropForeign('assignment_history_from_foreign');
            $table->dropForeign('assignment_history_to_foreign');
        });
    }
};
