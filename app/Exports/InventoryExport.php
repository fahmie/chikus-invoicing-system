<?php

namespace App\Exports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;

class InventoryExport implements FromQuery,ShouldAutoSize,WithMapping,WithHeadings,WithEvents
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

    public function supplier(string $supplier)
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function query()
    {
        return Inventory::query()->where('supplier_id',$this->supplier)->whereBetween('date', [$this->dateform,  $this->dateend]);
    }

    public function map($inventory): array
    {
        return [
            // $pettycash->sites->name,
            $inventory->date,
            $inventory->time,
            $inventory->suppliers->name,
            $inventory->products->name,
            $inventory->stock_in,
            $inventory->stock_out,
            $inventory->stock,
            $inventory->remark,
        ];
    }

    public function headings(): array
    {
        return [
            'Date',
            'Time',
            'Supplier',
            'Product',
            'Stock In',
            'Stock Out',
            'Balance Stock',
            'Remark'
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeExport::class  => function(BeforeSheet $event){
                $event->sheet->insertNewColumnBefore('A', 2);
                $event->sheet->setCellValue('A1', 'Inventory')->applyFromArray([
                    'font' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        'bold' => true
                    ],
                ]);
            },

            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:H1')->applyFromArray([
                    'font' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        'bold' => true
                    ],
                ]);
            }
        ];
    }

}
