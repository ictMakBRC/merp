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
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('asset_name');
            $table->unsignedBigInteger('asset_category_id')->index('assets_asset_category_id_foreign');
            $table->unsignedBigInteger('asset_subcategory_id')->index('assets_asset_subcategory_id_foreign');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('barcode')->unique();
            $table->string('engraved_label')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->index('assets_user_id_foreign');
            $table->unsignedBigInteger('station_id')->nullable()->index('assets_station_id_foreign');
            $table->unsignedBigInteger('department_id')->nullable()->index('assets_department_id_foreign');
            $table->string('condition')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable()->index('assets_vendor_id_foreign');
            $table->double('purchase_price', 12, 2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('purchase_order_number')->nullable();
            $table->date('warranty_end')->nullable();
            $table->string('depreciation_method')->nullable();
            $table->double('depreciation_rate', 3, 2)->nullable();
            $table->integer('expected_useful_years')->nullable();
            $table->unsignedBigInteger('insurance_company')->nullable();
            $table->unsignedBigInteger('insurance_type')->nullable();
            $table->date('insurance_end')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('assets');
    }
};
