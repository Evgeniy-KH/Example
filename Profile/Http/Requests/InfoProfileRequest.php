<?php

namespace Modules\Profile\Http\Requests;

use Modules\Profile\Entities\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Profile\Rules\{
    CityExixtsRules,
    IdCustomUserRule
};

class InfoProfileRequest extends FormRequest
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
            'login' => 'required|max:150|unique:users,login,' . Auth::id(),
            'email' => 'required|max:150|unique:users,email,' . Auth::id(),
            'country_id' => 'required|exists:countries,id_country',
            'first_name' => 'nullable|max:20',
            'last_name' => 'nullable|max:20',
            'id_custom' => ['required', 'max:100', new IdCustomUserRule],
            'city' => ['required', new CityExixtsRules(request()->country_id, new City())]
        ];
    }
}