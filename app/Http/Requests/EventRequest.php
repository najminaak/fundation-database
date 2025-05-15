<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize()
    {
        return true; // sesuaikan dengan middleware auth jika perlu
    }

    public function rules()
    {
        return [
            'event.name' => 'required|string|max:255',
            'event.description' => 'nullable|string',
            'event.date' => 'nullable|date',

            'organizer.user_id' => 'required|integer|exists:users,id',

            'event_photos' => 'required|array',
            'event_photos.*.photo_file' => 'required|string|max:255',

            'event_categories' => 'required|array',
            'event_categories.*.event_category_names_id' => 'required|integer|exists:event_category_names,id',

            'event_fund.target_fund' => 'nullable|numeric|min:0',
            'event_fund.sponsor_deadline' => 'nullable|date',

            'event_placement.event_start_date' => 'nullable|date',
            'event_placement.event_end_date' => 'nullable|date|after_or_equal:event_placement.event_start_date',
            'event_placement.event_venue' => 'nullable|string|max:255',
            'event_placement.address' => 'nullable|string|max:500',
            'event_placement.city' => 'nullable|string|max:100',
            'event_placement.province' => 'nullable|string|max:100',

            'kontraprestasi' => 'nullable|array',
            'kontraprestasi.*.icon_photo_kontraprestasi_id' => 'required|integer|exists:icon_photo_kontraprestasis,id',
            'kontraprestasi.*.title' => 'required|string|max:255',
            'kontraprestasi.*.min_sponsor' => 'required|integer|min:0',
            'kontraprestasi.*.max_sponsor' => 'required|integer|min:0',
            'kontraprestasi.*.feedback' => 'nullable|string',

            'sponsors' => 'nullable|array',
            'sponsors.*.amount' => 'required|numeric|min:0',
            'sponsors.*.entrepreneur_id' => 'required|integer|exists:entrepreneurs,id',

            'participant_categories' => 'nullable|array',
            'participant_categories.*.name' => 'required|string|max:255',
        ];
    }
}
