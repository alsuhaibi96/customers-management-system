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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('serial_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('neighbourhood')->nullable();
            $table->decimal('download_speed_before_installing', 8, 2)->nullable();
            $table->decimal('download_speed_after_installing', 8, 2)->nullable();
            $table->decimal('upload_speed_before_installing', 8, 2)->nullable();
            $table->decimal('upload_speed_after_installing', 8, 2)->nullable();
            $table->decimal('ping_before_installing', 8, 2)->nullable();
            $table->decimal('ping_after_installing', 8, 2)->nullable();
            $table->string('internet_tower')->nullable();
            $table->string('cell_number')->nullable();
            $table->decimal('bandwidth_strength_after_installing', 8, 2)->nullable();
            $table->decimal('signal_db_after_installing', 8, 2)->nullable();
            // 'devices_used' will be handled via a pivot table with 'products'
            $table->string('card_used')->nullable();
            $table->text('notes')->nullable();
            $table->text('extra_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
