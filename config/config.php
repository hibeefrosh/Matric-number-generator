<?php

return [
    'app' => [
        'name' => ' matricno-generator',
        'url' => 'http://localhost/matricno-generator',
    ],
    'database' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'matricno-generator',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // Add other database options if needed
        ],
    ],
    // Add more configuration settings as needed
];
