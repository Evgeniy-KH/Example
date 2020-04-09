<?php

namespace Modules\Profile\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Profile\Rules\IdCustomUserRule;

class PhoneNumberRequest extends FormRequest
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
            'phone' => 'required|phone:phone_country|unique:profiles_users_info,phone,' . Auth::id(),
            'phone_country' => 'required_with:phone',
        ];
    }
}