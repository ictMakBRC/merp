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
        Schema::create('asset_issues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reference')->unique();
            $table->string('subject');
            $table->string('issue_type')->nullable();
            $table->unsignedBigInteger('asset_id')->index('asset_issues_asset_id_foreign');
            $table->string('priority')->nullable();
            $table->string('deadline')->nullable();
            $table->unsignedBigInteger('station_id')->nullable()->index('asset_issues_station_id_foreign');
            $table->unsignedBigInteger('source_dept')->nullable()->index('asset_issues_source_dept_foreign');
            $table->unsignedBigInteger('destination_dept')->nullable()->index('asset_issues_destination_dept_foreign');
            $table->longText('description')->nullable();
            $table->string('issue_status')->default('Pending');
            $table->longText('reason')->nullable();
            $table->unsignedBigInteger('created_by');
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
        Schema::dropIfExists('asset_issues');
    }
};
