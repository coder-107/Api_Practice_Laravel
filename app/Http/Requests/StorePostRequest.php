<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'status'      => 'required|in:Active,Inactive,Draft',
        ];

        if ($this->isMethod('post')) {
            $rules['images'] = 'required|image|mimes:jpg,jpeg,png|max:2048';
        } else {
            $rules['images'] = 'nullable|image|mimes:jpg,jpeg,png|max:2048';
        }

        return $rules;
    }


    /**
     * Custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Title is required!',
            'description.required' => 'Description is required.',
            'images.required' => 'Please select an image.',
            'images.image' => 'The uploaded file must be an image.',
            'images.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif.',
            'images.max' => 'Image size should not exceed 2MB.',
            'status.required' => 'Status is required.',
            'status.in' => 'Invalid status. Must be one of: Active, Inactive, Draft.'
        ];
    }
}
