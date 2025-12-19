<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateFolderRequest extends FormRequest
{
 
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'container' => 'nullable|integer|exists:folders,id',
            'owner' => 'sometimes|nullable|exists:users,id',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $response = response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
