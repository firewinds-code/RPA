<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class TableExportController extends Controller
{
    public function export(Request $request)
    {
        try {
            $tablName = $request->name;
            $fileName = $tablName . '.csv';
            $columns = array_slice(Schema::getColumnListing($tablName), 1, -3);
            $columns = Schema::getColumnListing($tablName);
            $columns = DB::getSchemaBuilder()->getColumnListing($tablName);
            $columns = array_diff($columns, array('created_at', 'updated_at', 'created_by', 'id'));
            //dd($columns);
            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );
            $callback = function () use ($columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }
}