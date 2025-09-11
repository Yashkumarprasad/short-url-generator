<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string'
        ];

        if (Auth::guard('admin')->user()->user_type != SUPER_ADMIN) {
            $rules['role'] = 'required';
        }

        $rules['password'] = 'required|string|confirmed';
        
        $loginUser = Auth::guard('admin')->user();
        $role = $this->input('role');
        if ($loginUser->user_type == SUPER_ADMIN) {
            $role = ADMIN;
        }

        $rules['email'] = [
            'required',
            'email',
            Rule::unique('users')->where(function ($query) use ($role) {
                return $query->where('user_type', $role);
            }),
        ];

        return $rules;
    }
}
