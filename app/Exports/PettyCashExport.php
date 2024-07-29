<?php

namespace App\Exports;

use App\Models\PettyCash;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;

class PettyCashExport implements FromQuery,ShouldAutoSize,WithMapping,WithHeadings,WithEvents
{
    use Exportable;

    public function fromDate(string $dateform)
    {
        $this->dateform = $dateform;

        return $this;
    }

    public function endDate(string $dateend)
    {
        $this->dateend = $dateend;

        return $this;
    }

    public function sites(string $sites)
    {
        $this->sites = $sites;

        return $this;
    }

    public function query()
    {
        return PettyCash::query()->where('sites_id',$this->sites)->whereBetween('date', [$this->dateform,  $this->dateend]);
    }

    public function map($pettycash): array
    {
        return [
            // $pettycash->sites->name,
            $pettycash->date,
            $pettycash->time,
            $pettycash->detail,
            $pettycash->debit/100,
            $pettycash->credit/100,
            $pettycash->balance/100,
            $pettycash->remark,
        ];
    }

    public function headings(): array
    {
        return [
            'Date',
            'Time',
            'Detail',
            'Debit',
            'Credit',
            'Balance',
            'Remark'
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeExport::class  => function(BeforeSheet $event){
                $event->sheet->insertNewColumnBefore('A', 2);
                $event->sheet->setCellValue('A1', 'Petty Cash')->applyFromArray([
                    'font' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        'bold' => true
                    ],
                ]);
            },

            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:G1')->applyFromArray([
                    'font' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        'bold' => true
                    ],
                ]);
            }
        ];
    }

}
