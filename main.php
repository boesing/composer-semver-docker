#!/usr/bin/env php
<?php
declare(strict_types=1);

use Boesing\ComposerSemverDocker\ComposerSemverMatchCommand;
use Composer\InstalledVersions;
use Symfony\Component\Console\Application;

require __DIR__ . '/vendor/autoload.php';

$app = new Application('composer-semver', InstalledVersions::getPrettyVersion('boesing/composer-semver-docker'));
$app->add(new ComposerSemverMatchCommand());
$app->run();
