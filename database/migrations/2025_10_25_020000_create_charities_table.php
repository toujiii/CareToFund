<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('charities', function (Blueprint $table) {
             $table->increments('charity_id');
            $table->unsignedInteger('request_id');
            $table->integer('raised');
            $table->enum('charity_status', ['Ongoing', 'Finished', 'Cancelled']);
            
            $table->index('request_id', 'charity_request_fk');
            $table->foreign('request_id', 'charity_request_fk')
                  ->references('request_id')
                  ->on('charity_requests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charities');
    }
};
