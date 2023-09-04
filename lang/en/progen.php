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
        'new_customer' => 'New Customer',
        'new_customer_details' => 'Create a new costumer with specific details.',
        'customer_name' => 'Customer name',
        'customer_code' => 'Customer code',
        'select_import_method' => 'Select a method of import',

        'form_new_customer' => [
            'single' => 'Single',
            'massive' => 'Massive',
            'from_table' => 'From Table',
            'success' => 'Customer successfully created',
            'error' => 'Customer not created',
        ],

        'edit_customer' => [
            'manage_people' => 'Manage people',
            'manage_people_description' => 'In this tab you will find all the enabled operators in the table below, to add a new user select types and type the name in the search bar.',
        ],

        'users' => [
            'select_users' => 'Select users',
            'user_type' => 'User type',
            'user_leader' => 'Leader',
            'users_associated' => 'Users associated!',
            'users_disassociated' => 'Users disassociated!',
            'users_not_associated' => 'Failed users association', 
            'users_not_disassociated' => 'Failed users disassociation', 
        ],

    ],

    'import_types' => [
        'Single' => 'Single',
        'Massive' => 'Massive',
        'Table' => 'From Table'
    ]

];
