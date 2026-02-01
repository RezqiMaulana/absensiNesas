<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AttendanceExport implements FromQuery, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct($filters) {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = Attendance::query()->with(['student.classroom.building', 'submitter']);

        if ($this->filters['start_date'] && $this->filters['end_date']) {
            $query->whereBetween('date', [$this->filters['start_date'], $this->filters['end_date']]);
        }

        if ($this->filters['building_id']) {
            $query->whereHas('student.classroom', function($q) {
                $q->where('building_id', $this->filters['building_id']);
            });
        }

        return $query->latest('date');
    }

    public function headings(): array {
        return ['Tanggal', 'Nama Siswa', 'Kelas', 'Gedung', 'Status', 'Catatan', 'Diinput Oleh'];
    }

    public function map($attendance): array {
        return [
            $attendance->date->format('d-m-Y'),
            $attendance->student->name,
            $attendance->student->classroom->name,
            $attendance->student->classroom->building->name,
            strtoupper($attendance->status),
            $attendance->notes ?? '-',
            $attendance->submitter->name,
        ];
    }
}
