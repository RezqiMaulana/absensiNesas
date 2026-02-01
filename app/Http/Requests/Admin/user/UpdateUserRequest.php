<?php

namespace App\Http\Requests\Admin\user;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        // Ambil ID user dari route agar validasi unique mengabaikan user ini
        $userId = $this->route('user')->id;

        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,' . $userId,
            'role' => 'required|in:admin,piket,wali_kelas,perwakilan_siswa',
            'classroom_id' => 'nullable|required_if:role,wali_kelas,perwakilan_siswa|exists:classrooms,id',
            'password' => 'nullable|string|min:6|confirmed', // Nullable saat update
        ];
    }

    public function messages(): array
    {
        return [
            'username.unique' => 'Username sudah terpakai.',
            'classroom_id.required_if' => 'Penempatan kelas wajib dipilih untuk role ini.',
        ];
    }
}
