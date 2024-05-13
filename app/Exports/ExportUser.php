<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\withStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportUser implements FromCollection, WithHeadings, ShouldAutoSize, withEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $tableShow = User::select('id_karyawan', 'name', 'kuota_cuti')->get();
        return $tableShow;
    }

    public function headings(): array {
        return [
            "ID Karyawan", "Nama", "Kuota Cuti"
        ];
    
}

public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14)->setBold(true);
            },
        ];
    }


public function styles(Worksheet $sheet)
{
    $sheet = User::select('id_karyawan', 'name', 'sisa_cuti')->get();
    return [
       // Style the first row as bold text.
       1    => ['font' => ['bold' => true]],
    ];
}
}
