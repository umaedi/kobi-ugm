<?php

namespace App\Exports;

use App\Models\Str;
use Maatwebsite\Excel\Concerns\FromQuery;

class StrExport implements FromQuery
{
    public function __construct(string $keyword)
    {
        $this->status = $keyword;
    }
    public function query()
    {
        return Str::query()->select('nama', 'program_studi', 'universitas', 'no_hp', 'email', 'nama_perusahaan')
            ->where('status', $this->status);
    }
}
