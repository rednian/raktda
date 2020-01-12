<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // dd($this->user());
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
            // 'empty_document'=> '',
            'name_en'=> 'required|max:255',
            'name_ar'=> 'required|max:255',
            'trade_license'=> 'required|max:255',
            'trade_license_issued_date'=> 'required|max:255|date',
            'trade_license_expired_date'=> 'required|max:255|date',
            'company_email'=> 'required|max:255|email',
            'phone_number'=> 'required|max:255',
            'website'=> 'nullable|max:255',
            'address'=> 'required|max:255',
            'address'=> 'required|max:255',
            'area_id'=> 'required|max:255',
            'company_description_en'=> 'required|max:255',
            'company_description_ar'=> 'required|max:255',
            'contact_name_en'=> 'required|max:255',
            'contact_name_ar'=> 'required|max:255',
            'designation_en'=> 'required|max:255',
            'designation_ar'=> 'required|max:255',
            'email'=> 'required|max:255|email',
            'mobile_number'=> 'required|max:255',
            'emirate_identification'=> 'required|max:255',
            'emirate_id_issued_date'=> 'required|max:255',
            'submit'=> 'required|max:255',
            // 'emirate_id_expired_date'=> 'required|max:255',
        ];
    }
}
