<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'integer|min:0',
            
            'photo' => 'sometimes|file|mimetypes:image/png,image/jpeg,image/webp,max:10240',
            // photos column
            'file_path' => 'string',
            'original_filename' => 'string',
            'file_size' => 'string',
            'mime_type' => 'string',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'] = 'sometimes|required|string|max:255';
            $rules['price'] = 'sometimes|required|numeric|min:0';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'the product name is required',
            'name.string' => 'the product name must be string',
            'name.max' => 'Product name is too long. Please shorten it',
            'price.required' => 'Please enter the price for the product',
            'price.numeric' => 'Price should be in numbers',
            'price.min' => 'Price should have at least 0',
            'stock.integer' => 'Please enter stock count for this product',
            'stock',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
