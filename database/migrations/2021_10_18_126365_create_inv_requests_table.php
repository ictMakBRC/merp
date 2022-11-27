<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_code')->nullable();
            $table->string('request_type')->default('Internal');
            $table->foreignId('department_id')->nullable()->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('borrower_id')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('approver_id')->nullable();
            $table->foreignId('inventoryclerk_id')->nullable();
            $table->string('request_state')->default('open');
            $table->string('borrow_state')->default('na');
            $table->integer('is_active')->default(0);
            $table->date('date_added')->nullable();
            $table->string('reqcomment')->nullable()->default('na');
            $table->date('date_approved')->nullable();
            $table->string('request_year')->nullable();
            $table->string('request_month')->nullable();
            $table->string('request_week')->nullable();
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
        Schema::dropIfExists('inv_requests');
    }
}
