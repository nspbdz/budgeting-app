<?php

namespace App\Exports;

use App\Departement;
use Maatwebsite\Excel\Concerns\FromCollection;

class DepartmentsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
      

    public function collection()
    {
        return Departement::all();
    }
}
