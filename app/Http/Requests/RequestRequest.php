<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRequest extends FormRequest
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
            'description' => ['max:255'],
            'raised_to' => ['required', 'integer'],
            'invoice' => ['mimes:pdf,doc,docx','max:5048'],
            'prf' => ['mimes:pdf,doc,docx','max:5048'],

        ];
    }
}
