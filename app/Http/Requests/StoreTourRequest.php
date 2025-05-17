<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTourRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tours,slug',
            'description' => 'nullable|string',

            // زمان‌بندی
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',

            // قیمت و ظرفیت
            'price_per_person' => 'required|integer|min:0',
            'currency' => ['required', Rule::in(['تومان', 'ریال', 'دلار'])],
            'capacity' => 'required|integer|min:1',

            // جزئیات سفر
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'required|integer|min:0',
            'departure_location' => 'required|string|max:255',
            'transportation_type' => ['required', Rule::in(['air', 'bus', 'train'])],
            'hotel_info' => 'nullable|string',
            'food_count' => 'required|integer|min:0',
            'difficulty_level' => 'required|integer|between:1,5',

            // تصویر و وضعیت
            'image' => 'nullable|image|max:2048', // حداکثر ۲ مگ
        ];
    }


    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->start_date && $this->end_date && $this->duration_days) {
                try {
                    $startDate = Carbon::parse($this->start_date);
                    $endDate = Carbon::parse($this->end_date);
                    $expectedDuration = $startDate->diffInDays($endDate) + 1;

                    if ($expectedDuration !== (int)$this->duration_days) {
                        $validator->errors()->add('duration_days', 'مدت زمان سفر باید برابر با تعداد روزهای بین تاریخ شروع و پایان باشد.');
                    }
                } catch (\Exception $e) {
                    $validator->errors()->add('start_date', 'تاریخ‌ها نامعتبر هستند.');
                }
            }
        });
    }

}
