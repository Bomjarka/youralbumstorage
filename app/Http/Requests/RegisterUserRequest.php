<?php

namespace App\Http\Requests;


use App\Rules\PasswordRules;
use App\Rules\Registration\FirstNameRule;
use App\Rules\Registration\LastNameRule;
use App\Rules\Registration\PhoneRule;
use App\Rules\Registration\SecondNameRule;
use App\Rules\Registration\UserAgeRule;
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
            'second_name' => ['nullable', 'string', 'max:255', new SecondNameRule()],
            'last_name' => ['required', 'string', 'max:255', new LastNameRule()],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:11', 'max:11', 'unique:users', new PhoneRule()],
            'gender' => ['required', 'string'],
            'birthdate' => ['required', 'date', new UserAgeRule()],
            'password' => ['required', 'confirmed', PasswordRules::defaults()],
            'captcha' => ['string', 'required', 'max:255', 'captcha'],
        ];
    }

    public function messages()
    {
        return [
            //Логин и ФИО
            'login.required' => trans('validation-registration.login-required'),
            'login.unique' => trans('validation-registration.login-unique'),
            'first_name.required' => trans('validation-registration.first-name-required'),
            'last_name.required' => trans('validation-registration.last-name-required'),
            //Почта
            'email.required' => trans('validation-registration.email-required'),
            'email.unique' => trans('validation-registration.email-unique'),
            //Телефон
            'phone.min' => trans('validation-registration.phone-length', ['length' => PhoneRule::PHONE_LENGTH]),
            'phone.max' => trans('validation-registration.phone-length', ['length' => PhoneRule::PHONE_LENGTH]),
            'phone.unique' => trans('validation-registration.phone-unique'),
            'phone.required' => trans('validation-registration.phone-required'),
            //Возраст
            'birthdate.required' => trans('validation-registration.birthdate-required'),
            //капча
            'captcha' => trans('validation-captcha.failed')
        ];
    }
}
