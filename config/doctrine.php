<?php

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

return function (): EntityManagerInterface {

    $paths = [__DIR__.'/../src/Entity'];
    $isDevMode = false;

    $dbParams = [
        'driver' => 'pdo_mysql',
        'user' => 'root',
        'password' => 'root',
        'dbname' => 'broadcast',
        'url' => 'mysql:3306'
    ];

    $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
    $em = EntityManager::create($dbParams, $config);

    return $em;
};

