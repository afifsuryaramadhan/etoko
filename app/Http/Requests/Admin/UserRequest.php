<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'nama' => 'required|string|max:50',
        'email' => 'required|email|unique:users',
        'no_hp' => 'required',
        'alamat' => 'required',
        'roles' => 'nullable|string|in:ADMIN,USER'
        ];
    }
}
