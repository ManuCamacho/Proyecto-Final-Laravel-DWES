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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
          //  $table->string('num_invoice')->nullable();
            $table->dateTime('date')->nullable();
            $table->unsignedBigInteger('total')->nullable();
          //  $table->unsignedBigInteger('total_amount')->nullable();
            $table->unsignedBigInteger('user_id'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};