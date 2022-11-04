<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('amo_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('accessToken');
            $table->string('refreshToken');
            $table->unsignedBigInteger('expires');
            $table->string('baseDomain');
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
        Schema::dropIfExists('amo_accounts');
    }
};
