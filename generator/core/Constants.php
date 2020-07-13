<?php

namespace Generator;

class Constants{

    const DATA_TYPES = ['string', 'text', 'integer', 'double', 'date', 'datetime', 'image', 'boolean'];
    CONST INPUT_TYPES = ['text', 'date', 'datetime', 'file', 'number', 'textarea', 'email', 'password'];

    const MIGRATION_DATATYPES = [
        'image' => ['dataType' => 'text', 'seederDataType'=> 'imageUrl($width = 640, $height = 480),'],
        'text' => ['dataType' => 'text', 'seederDataType'=> 'realText($maxNbChars = 200, $indexSize = 2),'],
        'string' => ['dataType' => 'string', 'seederDataType'=> 'sentence($nbWords = 3, $variableNbWords = true),'],
        'boolean' => ['dataType' => 'boolean', 'seederDataType'=> 'boolean($chanceOfGettingTrue = 50),'],
        'integer' => ['dataType' => 'integer', 'seederDataType'=> 'numberBetween($min = 50, $max = 450),'],
        'date' => ['dataType' => 'date', 'seederDataType'=> 'date($format = "d/m/Y", $max = "now"),'],
        'datetime' => ['dataType' => 'datetime', 'seederDataType'=> 'dateTime($max = "now", $timezone = null)->format("d/m/Y H:i:s"),'],
        'double' => ['dataType' => 'double', 'seederDataType'=> 'randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),'],
        'unsignedBigInteger' => ['dataType' => 'unsignedBigInteger', 'seederDataType'=> 'numberBetween($min = 1, $max = 10),']
    ];

    // directories and files
    const MODELS_DIR = 'app/';
    const VIEWS_DIR = 'resources/views/admin/';
    const INDEX_FILE = self::VIEWS_DIR . 'index.blade.php';
    const DELETED_FILE = self::VIEWS_DIR . 'deleted.blade.php';
    const CONTROLLERS_DIR = 'app/Http/Controllers/';
    const REQUESTS_DIR = 'app/Http/Requests/';
    const MIGRATIONS_DIR = 'database/migrations/';
    const SEEDERS_DIR = 'database/seeds/';
    const DATABASE_SEEDER = self::SEEDERS_DIR . 'DatabaseSeeder.php';
    const JSON_DIR = 'generator/generated-entities/';
    const SIDEBAR_ITEMS = 'resources/views/layouts/sidebar-items.blade.php';
    const ROUTES_DIR = 'routes/web.php';

    // code needles
    const HTML_NEEDLE_START = '<!-- <needle for="||model||"> -->';
    const HTML_NEEDLE_END = '<!-- </needle> -->';
    const PHP_NEEDLE_START = '//<!-- <needle for="||model||"> -->';
    const PHP_NEEDLE_END = '//<!-- </needle> -->';

    const SEEDER_INSTANCE = '$this->call(||model||Seeder::class);';
}