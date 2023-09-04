<?php

namespace App\Imports;

use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RosterImport implements WithMultipleSheets, SkipsEmptyRows
{

    private $weekOfYear;

    public function __construct(string $weekOfYear)
    {
        $this->weekOfYear  = $weekOfYear;
    }


    /**
    * @return $array
    */
    public function sheets(): array
    {

        $today = Carbon::now(); 

        $rosterWeek = $today->setISODate(date('Y'), $this->weekOfYear);

        $from = $rosterWeek->startOfWeek()->format('d-m-Y'); 
        
        $to = $rosterWeek->endOfWeek()->format('d-m-Y');

        $period = CarbonPeriod::create($from, $to)->toArray();

        return [
            0 => new RosterImportDay($period[0]->format('Y-m-d')),
            1 => new RosterImportDay($period[1]->format('Y-m-d')),
            2 => new RosterImportDay($period[2]->format('Y-m-d')),
            3 => new RosterImportDay($period[3]->format('Y-m-d')),
            4 => new RosterImportDay($period[4]->format('Y-m-d')),
            5 => new RosterImportDay($period[5]->format('Y-m-d')),
            6 => new RosterImportDay($period[6]->format('Y-m-d')),
        ];
    }
}
