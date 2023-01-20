<?php

namespace App\Http\Controllers;

use App\Exports\EmergencyExport;
use App\Models\Emergency;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportToExcelController extends Controller
{
    public function ExportRecords()
    {
        return Excel::download(new EmergencyExport, 'emergency_archive.xlsx');
    }
}
