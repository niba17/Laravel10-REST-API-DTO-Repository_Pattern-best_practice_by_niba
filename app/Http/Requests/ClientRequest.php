<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ClientRequest extends FormRequest
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
                    'identifier' => 'required|max:255|min:5|unique:clients',
                    'password' => 'required|max:255|min:5',
                    'password_confirm' => 'required|same:password',
                ];
            case 'PUT':
                $client_uuid = $this->route('client');

                return [
                    'identifier' => 'nullable|max:225|min:5|unique:clients,identifier,' . $client_uuid . ',uuid',
                    'password' => 'nullable|max:225|min:5',
                    'password_confirm' => 'nullable|same:password',
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
                    'identifier.required' => 'Username / Email harus diisi!',
                    'identifier.unique' => 'Username / Email sudah ada!',
                    'identifier.max' => 'Maksimal karakter Username / Email adalah :max karakter!',
                    'identifier.min' => 'Minimal karakter Username / Email adalah :min karakter!',

                    'password.required' => 'Password harus diisi!',
                    'password.max' => 'Maksimal karakter Password adalah :max karakter!',
                    'password.min' => 'Minimal karakter Password adalah :min karakter!',

                    'password_confirm.required' => 'Konfirmasi Password harus diisi!',
                    'password_confirm.same' => 'Konfirmasi Password tidak sesuai!',
                ];
            case 'PUT':
                return [
                    'identifier.unique' => 'Username / Email sudah ada!',
                    'identifier.max' => 'Maksimal karakter Username / Email adalah :max karakter!',
                    'identifier.min' => 'Minimal karakter Username / Email adalah :min karakter!',

                    'password.max' => 'Maksimal karakter Password adalah :max karakter!',
                    'password.min' => 'Minimal karakter Password adalah :min karakter!',

                    'password_confirm.same' => 'Konfirmasi Password tidak sesuai!',
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
