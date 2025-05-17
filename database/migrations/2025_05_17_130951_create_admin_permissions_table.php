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
        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->foreignId('permission_id')->constrained('permissions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('admins')->onUpdate('cascade')->onDelete('cascade');


            $table->primary(['permission_id', 'admin_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('admin_permissions');
    }
};
