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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->int('user_id');
            $table->string('name');
            $table->string('category');
            $table->decimal('cost', 10, 2);
            $table->double('unitPerCase');
            $table->double('unitPerPortion');
            $table->decimal('unit');
            $table->unsignedInteger('quantity');
            $table->integer('restockPoint');
            $table->string('status');         
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
