<?php

namespace App\Exports\Sheet;

use App\Models\Proof;
use App\Models\User;
use Carbon\CarbonPeriod;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class RosterPerDaySheet implements WithHeadings, WithTitle, FromCollection, ShouldAutoSize, WithEvents
{

    use Exportable;

    protected $date;
    protected  $selects;
    protected  $row_count;
    protected  $column_count;

    public function __construct(string $date)
    {
        $this->date = $date;

        $users = User::select('id','name')->get();

        $proofs = Proof::pluck('name')->toArray();

        sort($proofs);

        $selects = [  
            ['giustificativo'=>'C','options'=>$proofs],
        ];

        $this->selects = $selects;

        // numero di righe contenenti il menù a tendina
        $this->row_count = count($users) +1;

        //number of columns to be auto sized
        $this->column_count = 5;
    }

    public function headings(): array
    {

        $heading = [];

        // Aggiungo la colonna utenti
        $heading = [
            'id_utente',
            'nominativo',
            'giustificativo'
        ];

        $intervals = CarbonPeriod::since('06:00')->minutes(30)->until('24:00')->toArray();

        foreach ($intervals as $interval) {
            $to = next($intervals);
            if ($to !== false) {
                $heading[] = $interval->toTimeString('minutes');
            }
        }

        return $heading;
    }

    public function collection()
    {
        $users = User::select('id','name')->get();

        return $users;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->date;
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            // handle by a closure.
            AfterSheet::class => function(AfterSheet $event) {

                $row_count = $this->row_count;
                $column_count = $this->column_count;

                foreach ($this->selects as $select){

                    $drop_column = $select['giustificativo'];
                    $options = $select['options'];

                    // setto il menù a tendina
                    $validation = $event->sheet->getCell("{$drop_column}2")->getDataValidation();
                    $validation->setType(DataValidation::TYPE_LIST );
                    $validation->setErrorStyle(DataValidation::STYLE_INFORMATION );
                    $validation->setAllowBlank(false);
                    $validation->setShowInputMessage(true);
                    $validation->setShowErrorMessage(true);
                    $validation->setShowDropDown(true);
                    $validation->setErrorTitle('Input non valido');
                    $validation->setError('Valore non esistente nella lista.');
                    $validation->setPromptTitle('Seleziona dalla lista');
                    $validation->setPrompt('Seleziona un giustificativo dalla lista');
                    $validation->setFormula1(sprintf('"%s"',implode(',',$options)));

                    // clone validation to remaining rows
                    for ($i = 3; $i <= $row_count; $i++) {
                        $event->sheet->getCell("{$drop_column}{$i}")->setDataValidation(clone $validation);
                    }
                    // // set columns to autosize
                    // for ($i = 1; $i <= $column_count; $i++) {
                    //     $column = Coordinate::stringFromColumnIndex($i);
                    //     $event->sheet->getColumnDimension($column)->setAutoSize(true);
                    // }
                }

            }
        ];
    }

}
