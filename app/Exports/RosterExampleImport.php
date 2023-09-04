<?php

namespace App\Exports;

use App\Exports\Sheet\RosterPerDaySheet;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RosterExampleImport implements WithMultipleSheets
{

    use Exportable;

    private $weekOfYear;

    public function __construct(string $weekOfYear)
    {
        $this->weekOfYear = $weekOfYear;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {

        $today = Carbon::now(); 

        $weekNumber = $today->setISODate(date('Y'), $this->weekOfYear);
        
        $from = $weekNumber->startOfWeek()->format('d-m-Y'); 
        
        $to = $weekNumber->endOfWeek()->format('d-m-Y');
        
        $period = CarbonPeriod::create($from, $to);
        
        $sheets = [];

        // Convert the period to an array of dates
        $emptyRosterDays = $period->toArray();


        foreach ($emptyRosterDays as $emptyRosterDay) {
            $sheets[] = new RosterPerDaySheet($emptyRosterDay->format('d-m-Y'));
        }

        return $sheets;
    }

}
