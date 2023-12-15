<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\CromaMaster;
use Illuminate\Support\Facades\Auth;

class CromaImportData implements ToCollection
{
    public function collection(Collection $rows)
    {
        $records = [];

        // Skip the first row (header row)
        $rows->shift();

        foreach ($rows as $row) {
            $records[] = [
                'vendor_name'           => $row[0],
                'registered_phone'      => $row[1],
                'customer_name'         => $row[2],
                'customer_address'      => $row[3],
                'pincode'               => $row[4],
                'external_sr_num'       => $row[5],
                'product_category'      => $row[6],
                'machine_serial_number' => $row[7],
                'quantity'              => $row[8],
                'date_of_purchase'      => $row[9],
                'call_type'             => $row[10],
                'customer_email'        => $row[11],
                'address_line2'         => $row[12],
                'address_line3'         => $row[13],
                'purchased_from'        => $row[14],
                'alternate_phone'       => $row[15],
                'sf_code'               => $row[16],
                'unit_status'           => $row[17],
                'customer_remarks'      => $row[18],
                'created_by'            => Auth::user()->name,
            ];
        }

        CromaMaster::insert($records);

        return back()->with('success', 'Data Uploaded successfully');
    }
}