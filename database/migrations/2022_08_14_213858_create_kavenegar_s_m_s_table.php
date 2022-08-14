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
        Schema::create('kavenegar_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete()->cascadeOnUpdate();
            $table->bigInteger('message_id')->unique();
            $table->bigInteger('local_id')->unique()->nullable();
            $table->text('message');
            $table->integer('status');
            $table->text('status_text');
            $table->string('from');
            $table->string('to');
            $table->integer('price');
            $table->timestamp('send_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kavenegar_messages');
    }
};
