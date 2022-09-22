<?php

namespace App\Exports;

use App\Models\Universitas;
use Maatwebsite\Excel\Concerns\FromQuery;

class UserExport implements FromQuery
{

    public function __construct(string $keyword)
    {
        $this->thn_anggota = $keyword;
    }

    public function query()
    {
        return Universitas::query()->select('no_anggota', 'nama_univ', 'nama_fakultas', 'nama_jurusan', 'thn_anggota')
            ->where('thn_anggota', $this->thn_anggota)
            ->where('status', 1);
    }
}
