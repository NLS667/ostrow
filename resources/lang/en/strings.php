<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Strings Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in strings throughout the system.
    | Regardless where it is placed, a string can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'users' => [
                'delete_user_confirm'  => 'Na pewno chcesz usunąć tego użytkownika? To może przynieść nieoczwkiwane konsekwnencje.',
                'if_confirmed_off'     => '(Jeśli nie aktywny)',
                'restore_user_confirm' => 'Przywrócić tego użytkownika do normalnego stanu?',
            ],
        ],

        'dashboard' => [
            'title'   => 'Pulpit',
            'welcome' => 'Witaj',
        ],

        'general' => [
            'all_rights_reserved' => 'All Rights Reserved.',
            'are_you_sure'        => 'Are you sure you want to do this?',
            'continue'            => 'Continue',
            'member_since'        => 'Member since',
            'minutes'             => ' minutes',
            'search_placeholder'  => 'Search...',
            'timeout'             => 'You were automatically logged out for security reasons since you had no activity in ',

            'see_all' => [
                'messages'      => 'See all messages',
                'notifications' => 'View all',
                'tasks'         => 'View all tasks',
            ],

            'status' => [
                'online'  => 'Online',
                'offline' => 'Offline',
            ],

            'you_have' => [
                'messages'      => '{0} Nie masz żadnych wiadomości|{1} Masz 1 wiadomość|[2,Inf] Masz :number wiadomości',
                'notifications' => '{0} Nie masz żadnych powiadomień|{1} Masz 1 powiadomienie|[2,4] Masz :number powiadomienia|[5,Inf] Masz :number powiadomień',
                'tasks'         => '{0} Nie masz żadnych zadań|{1} Masz 1 zadanie[2,4] Masz :number zadania|[5,Inf] Masz :number zadań',
            ],
        ],

        'search' => [
            'empty'      => 'Please enter a search term.',
            'incomplete' => 'You must write your own search logic for this system.',
            'title'      => 'Search Results',
            'results'    => 'Search Results for :query',
        ],
    ],

    'emails' => [
        'auth' => [
            'error'                   => 'Whoops!',
            'greeting'                => 'Hello!',
            'regards'                 => 'Regards,',
            'trouble_clicking_button' => 'If you’re having trouble clicking the ":action_text" button, copy and paste the URL below into your web browser:',
            'thank_you_for_using_app' => 'Thank you for using our application!',

            'password_reset_subject'    => 'Reset Password',
            'password_cause_of_email'   => 'You are receiving this email because we received a password reset request for your account.',
            'password_if_not_requested' => 'If you did not request a password reset, no further action is required.',
            'reset_password'            => 'Click here to reset your password',

            'click_to_confirm' => 'Click here to confirm your account:',
        ],
    ],

    'frontend' => [
        'test' => 'Test',

        'tests' => [
            'based_on' => [
                'permission' => 'Permission Based - ',
                'role'       => 'Role Based - ',
            ],

            'js_injected_from_controller' => 'Javascript Injected from a Controller',

            'using_blade_extensions' => 'Using Blade Extensions',

            'using_access_helper' => [
                'array_permissions'     => 'Using Access Helper with Array of Permission Names or ID\'s where the user does have to possess all.',
                'array_permissions_not' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does not have to possess all.',
                'array_roles'           => 'Using Access Helper with Array of Role Names or ID\'s where the user does have to possess all.',
                'array_roles_not'       => 'Using Access Helper with Array of Role Names or ID\'s where the user does not have to possess all.',
                'permission_id'         => 'Using Access Helper with Permission ID',
                'permission_name'       => 'Using Access Helper with Permission Name',
                'role_id'               => 'Using Access Helper with Role ID',
                'role_name'             => 'Using Access Helper with Role Name',
            ],

            'view_console_it_works'          => 'View console, you should see \'it works!\' which is coming from FrontendController@index',
            'you_can_see_because'            => 'You can see this because you have the role of \':role\'!',
            'you_can_see_because_permission' => 'You can see this because you have the permission of \':permission\'!',
        ],

        'user' => [
            'change_email_notice'  => 'If you change your e-mail you will be logged out until you confirm your new e-mail address.',
            'email_changed_notice' => 'You must confirm your new e-mail address before you can log in again.',
            'profile_updated'      => 'Profile successfully updated.',
            'password_updated'     => 'Password successfully updated.',
        ],

        'welcome_to' => 'Welcome to :place',
    ],
];
