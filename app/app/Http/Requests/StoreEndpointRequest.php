<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEndpointRequest extends FormRequest
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
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'method' => 'required|in:GET,POST,PUT,DELETE',
            'expected_status' => 'required|integer',
            'timeout_ms' => 'nullable|integer|min:100',
            'interval_seconds' => 'required|integer|min:10',
            'headers' => 'nullable|array',
            'body' => 'nullable|array'
        ];
    }
}
