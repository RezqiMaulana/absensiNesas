<?php

namespace App\Http\Requests\Admin\user;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
                'username' => 'required|string|max:50|unique:users,username',
                'role' => 'required|in:admin,piket,wali_kelas,perwakilan_siswa',
                'classroom_id' => 'nullable|required_if:role,wali_kelas,perwakilan_siswa|exists:classrooms,id',
                'password' => 'required|string|min:6|confirmed',
            ];  
    }
    
    public function messages(): array
    {
        return [
            'username.unique' => 'Username ini sudah digunakan.',
            'classroom_id.required_if' => 'Kelas wajib diisi jika role adalah Wali Kelas atau Siswa.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];
    }
}
