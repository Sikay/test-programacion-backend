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
        Schema::create('historic_currencies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('fk_currency_id');
            $table->string('code');
            $table->string('name');
            $table->double('rate_usd');
            $table->timestamps();

            $table->foreign('fk_currency_id')
                ->references('id')
                ->on('currencies')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historic_currencies');
    }
};
