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
        Schema::create('asset_maintenance_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->unsignedBigInteger('authorised_by')->nullable()->index('asset_maintenance_info_authorised_by_foreign');
            $table->unsignedBigInteger('issue_ref')->index('asset_maintenance_info_issue_ref_foreign');
            $table->unsignedBigInteger('vendor')->nullable()->index('asset_maintenance_info_vendor_foreign');
            $table->unsignedBigInteger('internal_vendor')->nullable()->index('asset_maintenance_info_internal_vendor_foreign');
            $table->longText('description')->nullable();
            $table->longText('recommendation')->nullable();
            $table->date('maintenance_date')->nullable();
            $table->date('next_maintenance')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
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
        Schema::dropIfExists('asset_maintenance_info');
    }
};
