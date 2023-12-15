<?php

namespace App\Imports;

use App\Models\GenericMaster;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Auth;

class GenericImportData implements ToCollection
{
    public function collection(Collection $rows)
    {
        $records = [];
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
                'sr_no'                 => $row[7],
                'account_id'            => $row[8],
                'address_id'            => $row[9],
                'machine_serial_number' => $row[10],
                'quantity'              => $row[11],
                'date_of_purchase'      => $row[12],
                'call_type'             => $row[13],
                'customer_comments'     => $row[14],
                'purchased_from'        => $row[15],
                'capacity'              => $row[16],
                'primary_client'        => $row[17],
                'secondary_client'      => $row[18],
                'unit_status'           => $row[19],
                'symptom'               => $row[20],
                'product_group'         => $row[21],
                'account_type'          => $row[22],
                'sub_type'              => $row[23],
                'sf_code'               => $row[24],
                'serial_number'         => $row[25],
                'created_by'            => Auth::user()->name,
            ];
        }

        GenericMaster::insert($records);

        return back()->with('success', 'Data Uploaded successfully');
    }
}