<?php

namespace App\Exports;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;


class OrderExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    public $constrains;

    function __construct($constrains)
    {
        $this->constrains = $constrains;
    }

    public function collection()
    {
        return OrderResource::make(Order::where($this->constrains)->get());
    }

    public function headings(): array
    {
        return [
            'id',
            'price',
            'net_price',
            'shipment_fees',
            'discount',
            'paid',
            'created_at',
            'status',
            'email',
            'address',
            'area',
            'country',
            'mobile',
            'phone',
            'notes',
            'reference_id',
            'payment_method',
            'cash_on_delivery',
        ];
    }

    public function map($element): array
    {
        return [
            $element->id,
            $element->price,
            $element->net_price,
            $element->shipment_fees,
            $element->discount,
            $element->paid ? 'Paid' : 'N/A',
            $element->created_at->format('d-m-Y'),
            $element->status,
            $element->email,
            $element->address,
            $element->area,
            $element->country,
            $element->mobile,
            $element->phone,
            $element->notes,
            parse_str($element->reference_id),
            $element->payment_method,
            $element->cash_on_delivery ? 'Yes' : "No",
        ];
    }
}
