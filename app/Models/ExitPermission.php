<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExitPermission extends Model
{
    protected $fillable = ['student_id', 'teacher_id', 'piket_id', 'reason', 'leave_at', 'return_at', 'status'];

public function student() { return $this->belongsTo(student::class); }
public function teacher() { return $this->belongsTo(teachers::class); }
    public function piket() { return $this->belongsTo(User::class, 'piket_id'); }
}
