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
        Schema::create('facility_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('facility_name');
            $table->string('slogan');
            $table->text('about');
            $table->string('facility_type');
            $table->string('physical_address');
            $table->string('address2')->nullable();
            $table->string('contact');
            $table->string('contact2')->nullable();
            $table->string('email')->nullable();
            $table->string('email2')->nullable();
            $table->string('tin')->nullable();
            $table->string('website')->nullable();
            $table->string('fax')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo2')->nullable();
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
        Schema::dropIfExists('facility_information');
    }
};
