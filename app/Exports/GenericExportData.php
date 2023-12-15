<?php

namespace App\Exports;

use App\Models\GenericMaster;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class GenericExportData implements FromQuery, WithHeadings, WithMapping, WithStrictNullComparison
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
        return GenericMaster::query()
            ->select(
                'vendor_name',
                'registered_phone',
                'customer_name',
                'customer_address',
                'pincode',
                'external_sr_num',
                'product_category',
                'sr_no',
                'account_id',
                'address_id',
                'machine_serial_number',
                'quantity',
                'date_of_purchase',
                'call_type',
                'customer_comments',
                'purchased_from',
                'capacity',
                'primary_client',
                'secondary_client',
                'unit_status',
                'symptom',
                'product_group',
                'account_type',
                'sub_type',
                'sf_code',
                'serial_number',
                'created_at',
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
            'Pincode',
            'External SR Num',
            'Product Category',
            'SR No',
            'Account ID',
            'Address ID',
            'Machine Serial Number',
            'Quantity',
            'Date Of Purchase',
            'Call Type',
            'Customer Comments',
            'Purchased From',
            'Capacity',
            'Primary Client',
            'Secondary Client',
            'Uni Status',
            'Symptom',
            'Product Group',
            'Account Type',
            'Sub Type',
            'SF Code',
            'Serial Number',
            'Created At',
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
            $row->sr_no,
            $row->account_id,
            $row->address_id,
            $row->machine_serial_number,
            $row->quantity,
            $row->date_of_purchase,
            $row->call_type,
            $row->customer_comments,
            $row->purchased_from,
            $row->capacity,
            $row->primary_client,
            $row->secondary_client,
            $row->unit_status,
            $row->symptom,
            $row->product_group,
            $row->account_type,
            $row->sub_type,
            $row->sf_code,
            $row->serial_number,
            $row->created_at
        ];
    }
}