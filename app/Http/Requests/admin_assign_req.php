<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class admin_assign_req extends FormRequest
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
            'firstname'=>'required|regex:/^[a-zA-Z0-9- ]*$/',
            'lastname'=>'required|regex:/^[a-zA-Z0-9- ]*$/',
            'email'=>'required|email|unique:users',
        ];
    }
}
