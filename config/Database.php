<?php

function getDatabaseConfig()
{
    return [
        "database" => [
            "test" => [
                "url" => "mysql:host=localhost:3306;dbname=eshop_test",
                "username" => "root",
                "password" => "Sillarmysql123!"
            ],
            "prod" => [
                "password" => "Sillarmysql123!"
            ]
        ]
    ];
}
