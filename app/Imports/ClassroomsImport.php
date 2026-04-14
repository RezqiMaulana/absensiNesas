<?php

namespace App\Imports;

use App\Models\classroom;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Throwable;

class ClassroomsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, WithChunkReading
{
    public function model(array $row)
    {
        return new classroom([
            'name' => $row['name'],
            'building_id' => $row['building_id'],
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'building_id' => 'required|exists:buildings,id',
        ];
    }

    public function onError(Throwable $error)
    {
        // Log error or handle as needed
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}

