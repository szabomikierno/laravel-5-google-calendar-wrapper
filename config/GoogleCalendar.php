<?php

return [

    'credentials' => [
        'application_name' => env("APPLICATION_NAME"),
        'credentials_path' => env("CREDENTIALS_PATH"),
        'client_secret_path' => storage_path('app/client_secret.json'),
    ],

];