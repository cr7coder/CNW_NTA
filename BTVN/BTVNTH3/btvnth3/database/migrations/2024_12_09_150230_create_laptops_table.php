<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaptopsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laptops', function (Blueprint $table) {
            $table->id(); 
            $table->string('brand', 50); 
            $table->string('model', 100); 
            $table->text('specifications'); 
            $table->boolean('rental_status')->default(false); 
            $table->unsignedBigInteger('renter_id')->nullable(); 
            $table->timestamps();

       
            $table->foreign('renter_id')
                  ->references('id')
                  ->on('renters')
                  ->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laptops');
    }
}
