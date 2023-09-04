<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Progen Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for progen
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'customer' => [
        'new_customer' => 'Nuovo cliente',
        'new_customer_details' => 'Crea un nuovo cliente con dettagli specifici.',
        'customer_name' => 'Nome cliente',
        'customer_code' => 'Codice cliente',
        'select_import_method' => 'Seleziona il metodo di importazione',
        
        'form_new_customer' => [
            'single' => 'Singola',
            'massive' => 'Massiva',
            'from_table' => 'Da Tabella',
            'success' => 'Cliente creato con successo!',
            'error' => 'Cliente non creato'
        ],

        'edit_customer' => [
            'manage_people' => 'Gestisci operatori',
            'manage_people_description' => 'In questa sezione troverai tutti gli operatori abilitati nella tabella di sotto, per aggiungere un nuovo utente seleziona la tipologia di utente e digita il nome nella barra di ricerca.',
        ],

        'users' => [
            'select_users' => 'Seleziona utenti',
            'user_type' => 'Tipo utente',
            'user_leader' => 'Leader',
            'users_associated' => 'Utenti associati con successo!',
            'users_disassociated' => 'Utenti disassociati con successo!',
            'users_not_associated' => 'Associazione utenti non riuscita', 
            'users_not_disassociated' => 'Disassociazione utenti non riuscita', 
        ],
        
    ],

    'import_types' => [
        'Single' => 'Singola',
        'Massive' => 'Massiva',
        'Table' => 'Da Tabella'
    ]

];
