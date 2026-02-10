<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'item_name' => ['required'],
            'description' => ['required', 'max:255'],
            'image' => ['required', 'mime:jpeg,png'],
            'category' => ['required'],
            'condition' => ['required'],
            'price' => ['required', 'numeric', 'min:0'],
        ];
    }
}
