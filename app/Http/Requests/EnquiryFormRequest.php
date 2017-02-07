<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnquiryFormRequest extends FormRequest
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
            'enquiry.first_name' => 'required',
            'enquiry.email' => 'required|email|unique:enquiries,email',
            'enquiry.tel_number' => 'required',
            'enquiry.product_id' => 'required',
            'enquiry.message' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'enquiry.first_name.required' => 'Please provide a customer or company name.',
            'enquiry.email.unique' => 'This email has been used before, please provide a different email.',
            'enquiry.email.required' => 'Please provide an email address.',
            'enquiry.tel_number.required' => 'Please provide an telephone number.',
            'enquiry.product_id.required' => "Please select a product you're interested in.",
            'enquiry.message.required' => 'Please present detail to your enquiry.',
        ];
    }
}
