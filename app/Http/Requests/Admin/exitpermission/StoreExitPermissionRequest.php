<?php

namespace App\Http\Requests\Admin\exitpermission;

use Illuminate\Foundation\Http\FormRequest;

class StoreExitPermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teachers,id',
            'piket_id' => 'required|exists:users,id',
            'reason' => 'required|string|max:500',
            'leave_at' => 'required|date_format:H:i',
            'return_at' => 'nullable|date_format:H:i|after:leave_at',
            'status' => 'required|in:pending,approved,completed',
        ];
    }

    public function messages(): array
    {
        return [
            'student_id.required' => 'Siswa harus dipilih.',
            'student_id.exists' => 'Siswa yang dipilih tidak valid.',
            'teacher_id.required' => 'Guru pengajar harus dipilih.',
            'teacher_id.exists' => 'Guru yang dipilih tidak valid.',
            'piket_id.required' => 'Piket harus dipilih.',
            'piket_id.exists' => 'Piket yang dipilih tidak valid.',
            'reason.required' => 'Alasan keluar harus diisi.',
            'reason.max' => 'Alasan tidak boleh lebih dari 500 karakter.',
            'leave_at.required' => 'Waktu keluar harus diisi.',
            'leave_at.date_format' => 'Format waktu keluar tidak valid (HH:MM).',
            'return_at.after' => 'Waktu kembali harus setelah waktu keluar.',
            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status tidak valid.',
        ];
    }
}
?>

