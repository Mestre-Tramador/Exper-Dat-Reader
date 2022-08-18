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
        Schema::create('dats', function(Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->nullable()
            ->references('id')
            ->on('users');
            $table->timestamps();
            $table->dateTime('first_read_at');
            $table->dateTime('last_read_at');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dats');
    }
};
