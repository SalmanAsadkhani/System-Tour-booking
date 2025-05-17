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
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->foreignId('admin_id')->constrained('admins')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('role_id')->constrained('roles')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['role_id', 'admin_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_roles');
    }
};
