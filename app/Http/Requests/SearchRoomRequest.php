<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust authorization logic as necessary
    }

    /**
     * Get the validation rules for the request.
     */
    public function rules(): array
    {
        return [
            'numRooms' => 'required|integer|min:1|max:10',
            'rooms.*.places' => 'required|integer|min:1',
            'checkInDato' => 'required|date|after_or_equal:today',
            'checkOutDato' => 'required|date|after:checkInDato',
        ];
    }
}
