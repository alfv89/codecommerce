<?php

namespace CodeCommerce\Http\Requests;

use CodeCommerce\Http\Requests\Request;

class ProductRequest extends Request
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
            'name' => 'required|min:3|max:30|unique:products',
            'description' => 'required|string|min:5|max:255',
            'price' => 'required|numeric|min:1.00',
            'featured' => 'required|boolean',
            'recommend' => 'required|boolean'
        ];
    }
}
