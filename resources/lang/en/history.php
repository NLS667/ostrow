<?php

return [

    /*
    |--------------------------------------------------------------------------
    | History Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain strings associated to the
    | system adding lines to the history table.
    |
    */

    'backend' => [
        'none'            => 'Brak zdarzeń w historii.',
        'none_for_type'   => 'Brak zdarzeń w historii tego typu.',
        'none_for_entity' => 'Brak zdarzeń w historii dla :entity.',
        'recent_history'  => 'Historia',

        'roles' => [
            'created' => 'utworzył rolę.',
            'deleted' => 'usunął rolę.',
            'updated' => 'zaktualizował rolę.',
        ],
        'permissions' => [
            'created' => 'utworzył uprawnienie',
            'deleted' => 'usunął uprawnienie',
            'updated' => 'zaktualizował uprawnienie',
        ],
        'users' => [
            'changed_password'    => 'zmienił hasło użytkownika',
            'created'             => 'utworzył użytkownika',
            'deactivated'         => 'deaktywował użytkownika',
            'deleted'             => 'usunął użytkownika',
            'permanently_deleted' => 'permanentnie usunął użytkownika',
            'updated'             => 'zaktualizował użytkownika',
            'reactivated'         => 'reaktywował użytkownika',
            'restored'            => 'przywrócił użytkownika',
        ],
        'clients' => [
            'created'             => 'utworzył klienta',
            'deleted'             => 'usunął klienta',
            'updated'             => 'zaktualizował klienta',
            'deactivated'         => 'deaktywował klienta',
            'reactivated'         => 'reaktywował klienta',
            'permanently_deleted' => 'permanentnie usunął klienta',
            'restored'            => 'przywrócił klienta',
        ],
        'models' => [
            'created' => 'utworzył model urządzenia.',
            'deleted' => 'usunął model urządzenia.',
            'updated' => 'zaktualizował model urządzenia.',
        ],
        'services' => [
            'created' => 'utworzył usługę.',
            'deleted' => 'usunął usługę.',
            'updated' => 'zaktualizował usługę.',
            'category' => [
                    'created' => 'utworzył kategorię usług.',
                    'deleted' => 'usunął kategorię usług.',
                    'updated' => 'zaktualizował kategorię usług.',
            ],
        ],
        'producers' => [
            'created' => 'utworzył producenta.',
            'deleted' => 'usunął producenta.',
            'updated' => 'zaktualizował producenta.',
        ],
        'tasks' => [
            'created' => 'utworzył zadanie.',
            'deleted' => 'usunął zadanie.',
            'updated' => 'zaktualizował zadanie.',
            'finished' => 'zakończył zadanie.',
            'planned' => 'zaplanował zadanie.',
            'activated' => 'aktywował zadanie.',
            'type' => [
                'created' => 'utworzył rodzaj zadania.',
                'deleted' => 'usunął rodzaj zadania.',
                'updated' => 'zaktualizował rodzaj zadania.',
            ]
        ],
    ],
];
