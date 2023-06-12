<?php

use App\Models\Settings\GeneralSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->float('usd_rate')->nullable()->default('3650');
            $table->float('employee_nssf')->nullable()->default('5');
            $table->float('employer_nssf')->nullable()->default('10');
            $table->float('paye')->nullable()->default('30');
            $table->float('vat')->nullable()->default('18');            
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->timestamps();
        });

        $data = new GeneralSetting();
        $data->usd_rate =3650;
        $data->employee_nssf =5;
        $data->paye =30;
        $data->vat =18;
        $data->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
};
