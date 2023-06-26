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
        Schema::create('approval_chains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Employee_id')->constrained()->onDelete('Restrict')->onUpdate('Cascade');
            $table->string('type');
            $table->string('status')->default('Active');
            $table->timestamps();
        });

        Schema::table('general_settings', function(Blueprint $table1){
            $table1->integer('eur_rate')->default(0)->after('usd_rate');
            $table1->integer('gbp_rate')->default(0)->after('eur_rate');
            $table1->integer('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approval_chains');
    }
};
