<?php

namespace App\Http\Requests\Admin\teacher;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255|unique:teachers,nip,' . $this->route('teacher')->id,
            'subject' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama guru wajib diisi.',
            'nip.unique' => 'NIP sudah digunakan.',
            'subject.required' => 'Mata pelajaran wajib diisi.',
        ];
    }
}
