<?php

include __DIR__ . '/vendor/autoload.php';

// get rid of php file
array_shift($argv);
// get first argument
$input = array_shift($argv);
// get second argument
$output = array_shift($argv);

$app = new FaviconGenerator\Application(
	__DIR__ . DIRECTORY_SEPARATOR . 'application.json'
);

$ctrl = new FaviconGenerator\Generator($app);
if (!$ctrl->load($input)) {
	foreach ($ctrl->getErrors() as $err) {
		print($err . "\n");
	}
}

$ctrl->addPlatform(new FaviconGenerator\Platforms\Basic);
$ctrl->addPlatform(new FaviconGenerator\Platforms\iOS);
$ctrl->addPlatform(new FaviconGenerator\Platforms\IE10);
$ctrl->addPlatform(new FaviconGenerator\Platforms\IE11);

$html = $ctrl->generate($output);
if (!$html) {
	foreach ($ctrl->getErrors() as $err) {
		print($err . "\n");
	}
}