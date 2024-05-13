<?php

namespace App\Exports;

use App\Models\approval\PeminjamanModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\withStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class Export implements FromCollection, WithHeadings, ShouldAutoSize, withEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $tableShow = PeminjamanModel::select('real_id', 'name', 'reason', 'status_cuti', 'tgl_cuti', 'tgl_kembali', 'catatan', 'created_at', 'acc_by')->get();
        return $tableShow;
    }

    public function headings(): array {
        return [
            "ID Karyawan", "Nama", "Alasan", "Status", "tanggal mulai", "tanggal selesai", "Catatan", "Tanggal Pengajuan", "Disetujui oleh"
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
    $sheet = PeminjamanModel::select('real_id', 'name', 'reason', 'status_cuti', 'tgl_cuti', 'tgl_kembali', 'catatan', 'created_at', 'acc_by')->get();
    return [
       // Style the first row as bold text.
       1    => ['font' => ['bold' => true]],
    ];
}
}
