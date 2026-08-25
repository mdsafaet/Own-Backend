<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBuyerInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name' => [
                'required',
                'string',
                'max:255',
            ],

            'contact_person' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'country' => [
                'required',
                'string',
                'max:150',
            ],

            'product_code' => [
                'nullable',
                'string',
                'max:100',
            ],

            'estimated_quantity' => [
                'nullable',
                'integer',
                'min:1',
                'max:1000000000',
            ],

            'target_price' => [
                'nullable',
                'string',
                'max:100',
            ],

            'target_delivery_date' => [
                'nullable',
                'date',
                'after_or_equal:today',
            ],

            'attachment' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,jpg,jpeg,png',
                'max:10240',
            ],

            'message' => [
                'required',
                'string',
                'min:10',
                'max:5000',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'company_name.required' =>
                'Please enter your company name.',

            'contact_person.required' =>
                'Please enter the contact person’s name.',

            'email.required' =>
                'Please enter your email address.',

            'email.email' =>
                'Please enter a valid email address.',

            'country.required' =>
                'Please enter your country.',

            'estimated_quantity.min' =>
                'The estimated quantity must be at least 1.',

            'target_delivery_date.after_or_equal' =>
                'The target delivery date cannot be in the past.',

            'attachment.mimes' =>
                'The attachment must be a PDF, DOC, DOCX, JPG or PNG file.',

            'attachment.max' =>
                'The attachment must not be larger than 10 MB.',

            'message.required' =>
                'Please describe your product requirements.',

            'message.min' =>
                'Please provide at least 10 characters in your message.',
        ];
    }
}