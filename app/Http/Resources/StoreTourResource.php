<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreTourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request) : array
    {
        return [
        "title" =>  $request->title,
        "description" => $request->description ,
        "slug" => $request->slug ,
        "start_date" => $request->start_date ,
        "end_date" =>  $request->end_date,
        "departure_location" => $request->departure_location  ,
        "transportation_type" => $request->transportation_type  ,
        "hotel_info" => $request->hotel_info ,
        "food_count" =>  $request->food_count,
        "price_per_person" =>  $request->price_per_person,
        "currency" =>  $request->currency,
        "difficulty_level" => $request->difficulty_level  ,
        "duration_days" =>  $request->duration_days ,
        "duration_nights" => $request->duration_nights ,
        "capacity" => $request->capacity ,

     ];
    }
}
