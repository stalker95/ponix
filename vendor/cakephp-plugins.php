<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'ADmad/HybridAuth' => $baseDir . '/vendor/admad/cakephp-hybridauth/',
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'CsvView' => $baseDir . '/vendor/friendsofcake/cakephp-csvview/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'WyriHaximus/TwigView' => $baseDir . '/vendor/wyrihaximus/twig-view/'
    ]
];