<?php

use DI\ContainerBuilder;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$builder = new ContainerBuilder();
$definitions = require_once('services.php');
$builder->addDefinitions($definitions);
$container = $builder->build();

return ConsoleRunner::createHelperSet($container->get(\Doctrine\ORM\EntityManagerInterface::class));
