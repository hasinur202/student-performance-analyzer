<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportController extends Controller
{
    public function importStudentExcel (Request $request) {
        $request->validate([
            'year'  => 'required|integer',
            'institute_id'  => 'required',
            'class_id'  => 'required',
            'section_id'  => 'required',
            'shift_id'  => 'required',
            'file'  =>  'mimes:xls,xlsx,csv|max:3072',
        ]);

        $file = $request->file;
        $data = $request->all();

        Excel::import(new StudentImport($data), $file);

        return response()->json([
            'success' => true,
            'message' => 'Imported Successfully.'
        ], 200);
    }
}
