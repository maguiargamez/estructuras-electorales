<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class PromotedStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'structure_coordinator_id'=> ['required'],
            'firstname'=> ['required'],
            'lastname'=> ['required'],
            'sex'=> ['required'],
            'birth_date'=> ['required' , 'date_format:d/m/Y'],
            'electoral_key'=> ['required'],
            'electoral_key_validity'=> ['required'],
            'curp'=> ['required'],
            'section'=> ['required'],
            'section_type'=> ['required'],
            'address'=> ['required'],
            'neighborhood'=> ['required'],
            'zip_code'=> ['required'],
            'membership'=> ['required'],
            'political_organization'=> ['required'],
            'school_grade_id'=> ['required'],
            'activity_id'=> ['required'],
            'mobile_phone'=> ['required'],
            'house_phone'=> ['required'],
            'email'=> ['required'],
            'has_social_networks'=> ['required'],
        ];
    }
}
