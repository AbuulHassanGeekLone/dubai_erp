<?php

namespace App\Exports;

use App\Models\Journal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class journalExport implements FromView, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('account.journalx', [
            'journal' => Journal::all()
        ]);
    }
    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'Created at',
            'Updated at'
        ];
    }

}
