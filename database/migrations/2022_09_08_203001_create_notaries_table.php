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
        Schema::create('notaries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('national_id_photocopy');
            $table->string('notary_code');
            $table->string('district');
            $table->string('sector');
            $table->string('cell');
            $table->bigInteger('national_id');
            $table->string('image');
            $table->enum('status', \App\Models\Notary::STATUS)->default(\App\Models\Notary::PENDING);
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
        Schema::dropIfExists('notaries');
    }
};
