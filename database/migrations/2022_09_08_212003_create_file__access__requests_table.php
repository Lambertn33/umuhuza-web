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
        Schema::create('file__access__requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('file_id');
            $table->string('requested_by');
            $table->enum('status', \App\Models\File_Access_Request::STATUS)->default(\App\Models\File_Access_Request::PENDING);
            $table->boolean('has_been_viewed')->default(false);
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
        Schema::dropIfExists('file__access__requests');
    }
};
