<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->integer('seat_number');
            $table->float('price', 15, 2);
            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->timestamps();

            //Use soft delete
            $table->softDeletes();
        });


        // Insert sample data
        DB::table('event_details')->insert([
            ['event_id' => 1, 'seat_number' => 1, 'price' => 100, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['event_id' => 1, 'seat_number' => 2, 'price' => 100, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['event_id' => 1, 'seat_number' => 3, 'price' => 100, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['event_id' => 1, 'seat_number' => 4, 'price' => 100, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['event_id' => 1, 'seat_number' => 5, 'price' => 100, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['event_id' => 2, 'seat_number' => 1, 'price' => 50, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['event_id' => 2, 'seat_number' => 2, 'price' => 50, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['event_id' => 2, 'seat_number' => 3, 'price' => 50, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['event_id' => 2, 'seat_number' => 4, 'price' => 50, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['event_id' => 2, 'seat_number' => 5, 'price' => 50, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_details');
    }
};
