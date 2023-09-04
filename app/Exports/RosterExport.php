<?php

namespace App\Exports;

use App\Models\Roster;
use Maatwebsite\Excel\Concerns\FromCollection;

class RosterExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Roster::all();
    }
}
