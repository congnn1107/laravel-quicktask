<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
        $usernameUniqueRule = Rule::unique('users', 'username')->ignore($this->id ?? 0);
        $emailUniqueRule = Rule::unique('users', 'email')->ignore($this->id ?? 0);
        return [
            'first_name' => ['required', 'min:2', 'max:256'],
            'last_name' => ['required', 'min:2', 'max:256'],
            'username' => ['required', 'min:6', 'max:256', $usernameUniqueRule],
            'email' => ['required', 'email', $emailUniqueRule],
            'password' => ['required', 'min:8', 'same:password_confirm']
        ];
    }
}
