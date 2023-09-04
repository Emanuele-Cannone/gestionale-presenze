<?php

namespace App\Imports;

use App\Models\Proof;
use App\Models\Roster;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;

class RosterImportDay implements ToCollection, WithValidation, SkipsEmptyRows, WithChunkReading
{

    protected $weekDay;

    public function __construct(string $weekDay)
    {
        $this->weekDay = $weekDay;

    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

        $arrayRoster = $collection->toArray();
        
        $arrayColumns = $arrayRoster[0];

        $arrayProofs = Proof::whereIn('id', [10,19,22])->pluck('name')->toArray();


        foreach ($arrayRoster as $key => $rosterDay) {

            if($key != 0){

                $newRoster[$this->weekDay][$rosterDay[0]] = array_combine($arrayColumns, $rosterDay);
                
                Roster::updateOrCreate([
                    'date' => $this->weekDay,
                    'user_id' => $newRoster[$this->weekDay][$rosterDay[0]]['id_utente'],
                    'proof' => $newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'],
                    '06:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['06:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['06:00'] : 0,
                    '06:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['06:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['06:30'] : 0,
                    '07:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['07:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['07:00'] : 0,
                    '07:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['07:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['07:30'] : 0,
                    '08:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['08:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['08:00'] : 0,
                    '08:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['08:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['08:30'] : 0,
                    '09:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['09:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['09:00'] : 0,
                    '09:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['09:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['09:30'] : 0,
                    '10:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['10:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['10:00'] : 0,
                    '10:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['10:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['10:30'] : 0,
                    '11:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['11:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['11:00'] : 0,
                    '11:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['11:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['11:30'] : 0,
                    '12:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['12:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['12:00'] : 0,
                    '12:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['12:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['12:30'] : 0,
                    '13:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['13:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['13:00'] : 0,
                    '13:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['13:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['13:30'] : 0,
                    '14:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['14:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['14:00'] : 0,
                    '14:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['14:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['14:30'] : 0,
                    '15:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['15:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['15:00'] : 0,
                    '15:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['15:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['15:30'] : 0,
                    '16:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['16:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['16:00'] : 0,
                    '16:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['16:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['16:30'] : 0,
                    '17:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['17:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['17:00'] : 0,
                    '17:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['17:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['17:30'] : 0,
                    '18:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['18:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['18:00'] : 0,
                    '18:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['18:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['18:30'] : 0,
                    '19:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['19:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['19:00'] : 0,
                    '19:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['19:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['19:30'] : 0,
                    '20:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['20:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['20:00'] : 0,
                    '20:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['20:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['20:30'] : 0,
                    '21:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['21:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['21:00'] : 0,
                    '21:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['21:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['21:30'] : 0,
                    '22:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['22:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['22:00'] : 0,
                    '22:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['22:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['22:30'] : 0,
                    '23:00' => ($newRoster[$this->weekDay][$rosterDay[0]]['23:00'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['23:00'] : 0,
                    '23:30' => ($newRoster[$this->weekDay][$rosterDay[0]]['23:30'] && in_array($newRoster[$this->weekDay][$rosterDay[0]]['giustificativo'], $arrayProofs)) ? $newRoster[$this->weekDay][$rosterDay[0]]['23:30'] : 0 
                ],
                ['date', 'user_id']);
            
            }
            
        }

        Session::flash('success_message', __('attendance.success')); 

    }

    public function chunkSize(): int
    {
        return 300;
    }

    public function rules(): array
    {
        return [
            '1' => Rule::unique('users', 'id')
        ];
    }
}
