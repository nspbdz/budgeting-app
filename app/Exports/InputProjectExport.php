<?php

namespace App\Exports;

use App\ProjectDetail;
use Maatwebsite\Excel\Concerns\FromCollection;

class InputProjectExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProjectDetail::all();
    }
}
