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
            'area'          => 'required|string|in:conference room,navigatu hall|max:50',
            'event_date'    => 'required|date|date_format:Y-m-d',
            'start_time'    => 'required|date_format:H:i', // Hours and minutes
            'end_time'      => 'required|date_format:H:i|after:start_time',
        ];
    }
}