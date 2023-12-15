<?php

namespace App\Exports;
use App\Models\CromaMaster;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class CromaExportData implements FromQuery, WithHeadings, WithMapping, WithStrictNullComparison
{
    use Exportable;

    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function query()
    {
        return CromaMaster::query()
            ->select(
                'vendor_name',
                'registered_phone',
                'customer_name',
                'customer_address',
                'pincode',
                'external_sr_num',
                'product_category',
                'machine_serial_number',
                'quantity',
                'date_of_purchase',
                'call_type',
                'customer_email',
                'address_line2',
                'address_line3',
                'purchased_from',
                'alternate_phone',
                'sf_code',
                'unit_status',
                'customer_remarks',
                'created_at'
            )
            ->whereBetween('created_at', [$this->startDate, $this->endDate]);
    }

    public function headings(): array
    {
        return [
            'Vendor Name',
            'Registered Phone',
            'Customer Name',
            'Customer Address',
            'Pin Code',
            'External SR Num',
            'Product Category',
            'Machine Serial Number',
            'Quantity',
            'Date of Purchase',
            'Call Type',
            'Customer Email',
            'Address Line 2',
            'Address Line 3',
            'Purchased From',
            'Alternate Phone',
            'SF Code',
            'Unit Status',
            'Customer Comments',
            'Created At'
        ];
    }

    public function map($row): array
    {
        return [
            $row->vendor_name,
            $row->registered_phone,
            $row->customer_name,
            $row->customer_address,
            $row->pincode,
            $row->external_sr_num,
            $row->product_category,
            $row->machine_serial_number,
            $row->quantity,
            $row->date_of_purchase,
            $row->call_type,
            $row->customer_email,
            $row->address_line2,
            $row->address_line3,
            $row->purchased_from,
            $row->alternate_phone,
            $row->sf_code,
            $row->unit_status,
            $row->customer_remarks,
            $row->created_at
        ];
    }
}