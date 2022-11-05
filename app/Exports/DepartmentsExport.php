<?php

namespace App\Exports;

use App\Departement;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

// added
use Maatwebsite\Excel\Concerns\WithMapping;

class DepartmentsExport implements WithMapping
{
    use Exportable;

    private $fileName = 'Alokasies.csv';

    /**
    * Optional Writer Type
    */
    private $writerType = Excel::CSV;

    /**
    * Optional headers
    */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];


    // added for mapping data
    public function map($alokasi): array
    {
        return [
            $alokasi->id,
            // $alokasi->core->name,
            $alokasi->name,
            // $alokasi->created_at,
            // $alokasi->updated_at,
        ];
    }
    //

    public function headings(): array
    {
        return [
            '#',
            'core',
            'name',
            'created_at',
            'updated_at',
        ];
    }

    public function collection()
    {
        return Departement::all();
    }
}