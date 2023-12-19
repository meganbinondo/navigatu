<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'id'            => 'sometimes|exists:users,id', //sometimes will let the id optional but required if provided
            'area'          => 'sometimes|required|string|in:conference room,navigatu hall|max:50',
            'details'       => 'sometimes|nullable|string',
            'event_date'    => 'sometimes|required|date|date_format:Y-m-d',
            'start_time'    => 'sometimes|required|date_format:H:i', // Hours and minutes
            'end_time'      => 'sometimes|required|date_format:H:i|after:start_time',
            'status'        => 'nullable|string|in:pending,reserved,cancelled,done|max:50',
        ];
    }
}