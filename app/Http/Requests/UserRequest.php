<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    // public function rules(): array
    // {
    //     if( request()->routeIs('user.login') ) {
    //         return [
    //             'email'     => 'required|string|email|max:255',
    //             'password'  => 'required|min:8',
    //             //'role'      => 'admin',
    //         ];
    //     }
    //     else if( request()->routeIs('user.store') ) {
    //         return [
    //             'name'      => 'required|string|max:255',
    //             'email'     => 'required|string|email|unique:App\Models\User,email|max:255',
    //             'password'  => 'required|min:8',
    //         ];
    //     }
    //     else if( request()->routeIs('user.update') ){
    //         return [
    //             'name'      => 'required|string|max:255'
    //         ];
    //     }
    //     else if( request()->routeIs('user.email') ){
    //         return [
    //             'email'     => 'required|string|email|max:255',
    //         ];
    //     }
    //     else if( request()->routeIs('user.password') ){
    //         return [
    //             'password'  => 'required|confirmed|min:8',
    //         ];
    //     }
    // }

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
        } elseif ($this->routeIs('user.update')) {
            return [
                'name' => 'required|string|max:255',
            ];
        } elseif ($this->routeIs('user.email')) {
            return [
                'email' => 'required|string|email|max:255',
            ];
        } elseif ($this->routeIs('user.password')) {
            return [
                'password' => 'required|confirmed|min:8',
            ];
        }

        return [];
    }
}