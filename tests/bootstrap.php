<?php

// Register autoloaders

$loader = new \Phalcon\Loader();

/**
 * We register here the used directories, including the tests one, otherwise the TestCase couldn't be found.
 */
$loader->registerNamespaces([
    'MicheleAngioni\PhalconValidators' => dirname(__DIR__) . '/src/PhalconValidators',
    'MicheleAngioni\PhalconValidators\Tests' => dirname(__DIR__) . '/tests'
]);

$loader->register();
