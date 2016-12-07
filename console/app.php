<?php

use Chronotruck\Command\CheckVatNumber;
use Chronotruck\Vat\ViesValidator;
use DragonBe\Vies\Vies;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/vendor/autoload.php';

$application = new Application();

$application->add(new CheckVatNumber(new ViesValidator(new Vies())));

$application->run();
