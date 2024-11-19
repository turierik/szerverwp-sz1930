<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreOrUpdateRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:20',
            'content' => 'required|min:10',
            //'author_id' => 'required|integer|exists:users,id',
            'categories' => 'array',
            'categories.*' => 'integer|distinct|exists:categories,id',
            'imagefile' => 'nullable|file|image'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'A cím megadása kötelező!'
        ];
    }
}
