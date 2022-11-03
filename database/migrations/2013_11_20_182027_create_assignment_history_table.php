<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('from')->nullable()->references('id')->on('users')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('to')->nullable()->references('id')->on('users')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('assignment_history');
    }
}
