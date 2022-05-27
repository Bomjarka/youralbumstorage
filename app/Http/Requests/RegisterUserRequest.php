<?php

namespace App\Http\Requests;


use App\Rules\PasswordRules;
use App\Rules\Registration\FirstNameRule;
use App\Rules\Registration\LastNameRule;
use App\Rules\Registration\SecondNameRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'first_name' => ['required', 'string', 'max:255', new FirstNameRule()],
            'second_name' => ['required', 'string', 'max:255', new SecondNameRule()],
            'last_name' => ['required', 'string', 'max:255', new LastNameRule()],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:11', 'max:11', 'unique:users'],
            'gender' => ['required', 'string'],
            'birthdate' => ['required', 'date'],
            'password' => ['required', 'confirmed', PasswordRules::defaults()],
        ];
    }
}
