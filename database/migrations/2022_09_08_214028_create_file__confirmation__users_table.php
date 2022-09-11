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
        Schema::create('file__confirmation__users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('file_confirmation_id');
            $table->string('names');
            $table->bigInteger('telephone');
            $table->bigInteger('national_id');
            $table->string('confirmation_code');
            $table->enum('status', \App\Models\File_Confirmation_User::STATUS)->default(\App\Models\File_Confirmation_User::PENDING); 
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
        Schema::dropIfExists('file__confirmation__users');
    }
};
