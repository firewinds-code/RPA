<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\CromaExportData;
use App\Exports\GenericExportData;
use App\Models\CromaMaster;
use App\Imports\CromaImportData;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Imports\GenericImportData;
use App\Models\GenericMaster;

class SRController extends Controller
{
    public function index()
    {
        try {
            return view('sr.excel');
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function import(Request $request)
    {
        try {
            $category = $request->category;
            $validator = Validator::make($request->all(), [
                'file' => 'required|mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                if ($category == "croma") {
                    try {
                        $beforeCount = CromaMaster::count(); // Count records before import
                        Excel::import(new CromaImportData, $request->file('file'));
                        $afterCount = CromaMaster::count(); // Count records after import
                        $importedCount = $afterCount - $beforeCount; // Calculate the count of imported records
                    } catch (\Exception $e) {
                        return redirect()->back()->with('error', "Please import data in correct format in Date Of Purchase Column" );
                    }
                } else if ($category == "generic") {
                    try {
                        $beforeCount = GenericMaster::count();
                        Excel::import(new GenericImportData, $request->file('file'));
                        $afterCount = GenericMaster::count();
                        $importedCount = $afterCount - $beforeCount;
                    } catch (\Exception $e) {
                        return redirect()->back()->with('error', "Please import data in correct format in Date Of Purchase Column");
                    }
                } else {
                    return redirect()->back()->with('error', "Select a Category");
                }
                return redirect()->back()->with('success', "$importedCount data records imported successfully.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Something Went Wrong");
        }
    }


    public function report()
    {
        try {
            return view('sr.report');
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function daterange(Request $request)
    {
        try {
            $category = $request->category;
            $array = explode("@", $request->dateRangehid);
            $startDate = $array[0] . " 00:00:01";
            $endDate = $array[1] . " 23:59:59";
            if ($category == "croma") {
                return Excel::download(new CromaExportData($startDate, $endDate), 'croma_data.csv');
            } else if ($category == "generic") {
                return Excel::download(new GenericExportData($startDate, $endDate), 'generic_format_data.csv');
            } else {
                return redirect()->back()->with('error', "Select a Category");
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            return back()->with("error", "Something Went Wrong");
        }
    }
}