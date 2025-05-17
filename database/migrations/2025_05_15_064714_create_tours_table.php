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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();

            // اطلاعات عمومی تور
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // زمان‌بندی
            $table->dateTime('start_date');  // تاریخ حرکت (دقیق‌تر از string)
            $table->dateTime('end_date');    // تاریخ برگشت

            // قیمت و ظرفیت
            $table->unsignedBigInteger('price_per_person'); // عددی و قابل محاسبه
            $table->string('currency')->default('تومان');
            $table->unsignedInteger('capacity');

            // جزئیات سفر
            $table->unsignedInteger('duration_days');   // تعداد روزها
            $table->unsignedInteger('duration_nights'); // تعداد شب‌ها
            $table->string('departure_location');        // محل حرکت (مثلاً فرودگاه امام)
            $table->enum('transportation_type', ['air', 'bus', 'train'])->default('air');// وسیله نقلیه (مثلاً هواپیما)
            $table->text('hotel_info')->nullable();      // مشخصات هتل
            $table->unsignedTinyInteger('food_count')->default(0);  // تعداد وعده‌های غذایی
            $table->string('difficulty_level')->default(1); // مثلاً: آسان، متوسط، سخت

            // تصویر و وضعیت
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
