<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RadioCreateRequest extends FormRequest
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
            'radio_name' => 'required|string',
            'frequency' => 'required|numeric|lte:9999,99',
            'logo' => 'sometimes|nullable',
        ];
    }
}
