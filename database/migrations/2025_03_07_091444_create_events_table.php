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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('available_seats');
            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->timestamps();

            //Use soft delete
            $table->softDeletes();
        });



        // Insert data
        DB::table('events')->insert([
            ['name' => 'Event 1', 'available_seats' => 100, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Event 2', 'available_seats' => 50, 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
