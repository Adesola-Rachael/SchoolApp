<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnrolStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'grade' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string',
            'state' => 'required|string',
            'nationality' => 'required|string',
            'school_record' => 'required|file',
            'birth_certificate' => 'required|file',
        ];
    }
}
