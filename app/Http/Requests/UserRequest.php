<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'nama' => 'required|max:255|min:5|unique:users',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|max:255|min:5',
                ];
            case 'PUT':
                $user_id = $this->route('user');

                return [
                    'nama' => 'nullable|max:225|min:5|unique:users,nama,' . $user_id . ',id',
                    'email' => 'nullable|email|max:255|unique:users,email,' . $user_id . ',id',
                    'password' => 'nullable|max:225|min:5',
                ];
            default:
                break;
        }
    }

    public function messages()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'nama.required' => 'Nama harus diisi!',
                    'nama.unique' => 'Nama sudah ada!',
                    'nama.max' => 'Maksimal karakter Nama adalah :max karakter!',
                    'nama.min' => 'Minimal karakter Nama adalah :min karakter!',

                    'email.required' => 'Email harus diisi!',
                    'email.email' => 'Email harus berformat email!',
                    'email.unique' => 'Email sudah ada!',
                    'email.max' => 'Maksimal karakter Email :max!',

                    'password.required' => 'Password harus diisi!',
                    'password.max' => 'Maksimal karakter Password adalah :max karakter!',
                    'password.min' => 'Minimal karakter Password adalah :min karakter!',
                ];
            case 'PUT':
                return [
                    'nama.unique' => 'Nama sudah ada!',
                    'nama.max' => 'Maksimal karakter Nama adalah :max karakter!',
                    'nama.min' => 'Minimal karakter Nama adalah :min karakter!',

                    'email.unique' => 'Email sudah ada!',
                    'email.max' => 'Maksimal karakter Email :max!',

                    'password.max' => 'Maksimal karakter Password adalah :max karakter!',
                    'password.min' => 'Minimal karakter Password adalah :min karakter!',
                ];
            default:
                break;

        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException(
            $validator,
            response()->json([
                'message' => $validator->errors(),
            ], status: Response::HTTP_BAD_REQUEST)
        );
    }
}
