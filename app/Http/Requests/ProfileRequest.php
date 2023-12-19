<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        if ($this->routeIs('user.login')) {
            return [
                'email' => 'required|string|email|max:255',
                'password' => 'required|min:8',
            ];
        } elseif ($this->routeIs('user.store')) {
            return [
                'name' => 'required|string|max:255',
                'phone'  => 'required|ph_mobile',
                'organization'  => 'required|string',
                'email' => 'required|string|email|unique:users,email|max:255',
                'password' => 'required|min:8|confirmed',
                'role'  => 'sometimes'
            ];
        } elseif ($this->routeIs('profile.update')) {
            return [
                'name' => 'required|string|max:255',
                'phone'  => 'required|ph_mobile',
                'profile_picture' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];
        } elseif ($this->routeIs('profile.email')) {
            return [
                'email' => 'required|string|email|max:255',
            ];
        } elseif ($this->routeIs('profile.password')) {
            return [
                'password' => 'required|confirmed|min:8',
            ];
        }

        return [];
    }
}