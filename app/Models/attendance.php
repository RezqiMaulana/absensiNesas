<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class attendance extends Model
{
    protected $fillable = [
        'student_id',   // ID Siswa
        'submitted_by', // ID User yang menginput (Wali Kelas/Piket)
        'date',         // Tanggal Absensi
        'status',       // hadir, sakit, izin, alpa
        'notes'         // Catatan tambahan (misal: alasan sakit)
    ];

    /**
     * Casting tipe data otomatis.
     */
    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Relasi: Absensi ini milik satu siswa.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Relasi: Absensi ini diinput oleh seorang user (Guru/Piket).
     */
    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    /**
     * Scope untuk memfilter absensi hari ini.
     */
    public function scopeToday($query)
    {
        return $query->whereDate('date', now());
    }
}
