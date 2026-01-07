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
   {
    Schema::create('produks', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('jenis');
        $table->text('deskripsi')->nullable();
        $table->decimal('harga_jual', 10, 2);
        $table->decimal('harga_beli', 10, 2);
        $table->string('foto')->nullable();
        $table->timestamps();
    });
}
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};