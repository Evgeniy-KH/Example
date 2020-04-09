<?php

namespace Modules\Profile\Http\Requests;

use Modules\Profile\Entities\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Profile\Rules\{
    CityExixtsRules,
    IdCustomUserRule
};

class IntegrationRequest extends FormRequest
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
            'value' => 'required|url',
            'type_integration' => 'required|exists:profile_types_integration,type'
        ];
    }
}