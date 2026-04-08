<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEndpointRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'url' => 'sometimes|url',
            'method' => 'sometimes|in:GET,POST,PUT,DELETE',
            'expected_status' => 'sometimes|integer',
            'interval_seconds' => 'sometimes|integer|min:10'
        ];
    }
}
