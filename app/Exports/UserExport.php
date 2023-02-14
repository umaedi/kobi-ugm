<?php

namespace App\Exports;

use App\Models\Universitas;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromQuery, WithHeadings
{

    protected $thn_anggota;
    protected $status;
    public function __construct($keyword, $status)
    {
        $this->thn_anggota = $keyword;
        $this->status = $status;
    }

    public function query()
    {
        if ($this->thn_anggota != "") {
            return Universitas::query()->select('no_anggota', 'nama_univ', 'nama_fakultas', 'nama_jurusan', 'jenjang', 'email_kaprodi', 'email_user', 'alamat', 'no_tlp', 'no_wa', 'thn_anggota')
                ->where('thn_anggota', $this->thn_anggota)
                ->where('status', $this->status);
        }
        return Universitas::query()->select('no_anggota', 'nama_univ', 'nama_fakultas', 'nama_jurusan', 'jenjang', 'nama_kaprodi', 'email_kaprodi', 'email_user', 'alamat', 'no_tlp', 'no_wa', 'thn_anggota', 'created_at')
            ->where('status', $this->status);
    }

    public function headings(): array
    {
        return [
            'NO ANGGOTA',
            'NAMA UNIVERSITAS',
            'FAKULTAS',
            'PROGRAM STUDI',
            'JENJANG STUDI',
            'EMAIL KAPRODI',
            'EMAIL USER',
            'ALAMAT',
            'NO TLEPON',
            'NO WA',
            'TAHUN KE ANGGOTAAN',
            'TAHUN PENDAFTARAN'
        ];
    }
}
