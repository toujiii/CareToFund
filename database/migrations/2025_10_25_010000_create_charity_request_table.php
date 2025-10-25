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
        Schema::create('charity_requests', function (Blueprint $table) {
            $table->increments('request_id');
            $table->text('description');
            $table->dateTime('datetime');
            $table->dateTime('approved_datetime')->nullable();
            $table->integer('fund_limit');
            $table->integer('duration');
            $table->enum('id_type_used', ['Passport', "Drivers License", 'National ID']);
            $table->string('id_number', 50);
            $table->string('id_att_link', 255);
            $table->string('front_face_link', 255);
            $table->string('side_face_link', 255);
            $table->enum('request_status', ['Pending', 'Approved', 'Rejected']);
            $table->unsignedInteger('user_id');

            $table->index('user_id', 'user_id_fk');
            $table->foreign('user_id', 'user_id_fk')
                  ->references('id')
                  ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charity__requests');
    }
};
