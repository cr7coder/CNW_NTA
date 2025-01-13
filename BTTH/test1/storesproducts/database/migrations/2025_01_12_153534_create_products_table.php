<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
        $table->string('name');
        $table->string('description')->nullable();
        $table->float('price',10,2)->default(0);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('products');
}

};
