<?php

namespace App\Exports;

use App\Models\Emergency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmergencyExport implements FromCollection, WithHeadings
{

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Phone',
            'Longitude',
            'Latitude',
            'Details',
            'Severity_status',
            'Status',
            'Remarks'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Emergency::select(
            'emergency.id', 'users.name AS name', 'emergency.phone', 'emergency.longitude', 'emergency.latitude',
            'emergency.details', 'emergency.severity_status', 'emergency.status', 'emergency.remarks')
            ->leftjoin('users', 'emergency.user_id', '=', 'users.id')
            ->orderBy('emergency.created_at', 'DESC')
            ->where('emergency.status', '=', '10')
            ->where('emergency.status', '=', '10')
            ->get();
    }
}
