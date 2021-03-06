<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'slider_title' => 'required|min:3|max:255',
            'slider_description' => 'required|min:3|max:255',
            'slider_btn_text' => 'required|min:3|max:255',
            'slider_image' => 'required|mimes:jpg,png,jpeg|max:700000',
        ];
    }
}
