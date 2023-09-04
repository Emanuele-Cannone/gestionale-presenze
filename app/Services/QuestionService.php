<?php

namespace App\Services;


use App\Exceptions\QuestionException;
use App\Models\Question;
use App\Models\Roster;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class QuestionService
{
    /**
     * @param object
     * @return array
     */
    public function create(object $questionDto): array
    {

        $questionResolveToUsers = [];


        // 1 Allattamento
        // 2 Aspettativa
        // 3 Assistenza Familiare Con Grave Patologia
        // 4 Cambio Turno
        // 5 Congedo Matrimoniale
        // 6 Congedo Parentale
        // 7 Donazione Sangue - deve essere comunicato prima (accordi interni per preavviso). è di 1 giorno intero e NON SERVE APPROVAZIONE
        // 8 Ferie
        // 9 Infortunio
        // 10 Lavoro Fuori Sede
        // 11 Lutto
        // 12 Malattia
        // 13 Maternità
        // 14 Paternità
        // 15 Permesso - in base al monte ore e va approvato
        // 16 Permesso Sindacale - richiesta almeno 3 giorni prima, 2 se ha l'urgenza. QUANTE ORE AMMONTA?
        // 17 Permesso 104 - controllo di max 24 ore lavorative nel mese NON SERVE APPROVAZIONE
        // 18 Riposo
        // 19 SmartWorking
        // 20 Seggio Elettorale
        // 21 Studio
        // 22 Ufficio
        // 23 Visite Prenatali - almeno 15gg prima NON SERVE APPROVAZIONE



        // controllo che non ci sia una richiesta identica da parte dello stesso utente
        $questionExisting = Question::where('user_id', $questionDto->user_id)
                            ->whereFrom($questionDto->from)
                            ->whereTo($questionDto->to)
                            ->whereNull('accepted')
                            ->first();


        switch ($questionDto->proof_id) {
            case 8:
            case 15:

                // controllo che ci siano operatori nel turno per il quale sta chiedendo lo spostamento
                $questionResolveToUsers = Roster::where('date', Carbon::createFromDate($questionDto->from)->format('Y-m-d'))
                                    ->where(Carbon::createFromDate($questionDto->from)->format('H:i'), 1)
                                    ->where('user_id', '!=', $questionDto->user_id)
                                    ->pluck('user_id');
                                    // ->toSql();

                // inserisco in un array tutti gli utenti a cui notificare la richiesta
                $usersToNotify = Roster::where('date', Carbon::createFromDate($questionDto->from)->format('Y-m-d'))
                                ->where(Carbon::createFromDate($questionDto->from)->format('H:i'), 1)
                                ->where('user_id', '!=', $questionDto->user_id)
                                ->pluck('user_id');

                break;
                
            default:
                // throw new QuestionException();
        }
        

        
        if(!$questionExisting && $questionResolveToUsers){

            try {
                DB::beginTransaction();

                $newQuestion = Question::create([ 
                    'user_id' => $questionDto->user_id,
                    'proof_id' => $questionDto->proof_id,
                    'from' => $questionDto->from,
                    'to' => $questionDto->to,
                    'accepted' => $questionDto->accepted,
                    'note' => $questionDto->note
                ]);

                $notificationSendTo = [];

                foreach ($usersToNotify as $user) {
                    
                    $notificationSendTo[$user] = [
                        'read' => 0
                    ];
                };

                $users_to = [
                    'user_id' => $newQuestion->user_id,
                    'proof_id' => $newQuestion->proof_id,
                    'question_id' => $newQuestion->id,
                    'notificationSendTo' => $notificationSendTo
                ];

                Session::flash('success_message', __('attendance.success')); 
    
                DB::commit();
                
            } catch (Exception $e) {

                DB::rollBack();
                Log::error('richiesta fallita', [$e->getMessage()]);
            
            }

        } else {

            throw new QuestionException();

        }

        return $users_to;

    }

}