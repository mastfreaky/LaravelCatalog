<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCatalogSearchRequest extends FormRequest
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
            'search' => 'required|string|max:200',
            'type' => 'required|numeric|in:0,1'
        ];
    }
}
