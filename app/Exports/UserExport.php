<?php

namespace App\Exports;

use App\Models\Universitas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('backend.users.active', [
            'invoices' => Universitas::all()
        ]);
    }
}
