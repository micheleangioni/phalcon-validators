<?php

namespace MicheleAngioni\PhalconValidators\Tests;

use Phalcon\Di;
use Phalcon\Loader;
use Phalcon\Test\UnitTestCase as PhalconTestCase;

abstract class TestCase extends PhalconTestCase
{
    protected $_cache;

    /**
     * @var \Phalcon\Config
     */
    protected $_config;

    /**
     * @var bool
     */
    private $_loaded = false;


    public function setUp()
    {
        parent::setUp();

        // Load any additional services that might be required during testing
        $di = Di::getDefault();

        $di->set('modelsManager', function () {
            return new \Phalcon\Mvc\Model\Manager();
        });

        $di->set('modelsMetadata', function () {
            return new \Phalcon\Mvc\Model\Metadata\Memory();
        });

        $this->setDi($di);

        $this->_loaded = true;
    }

    protected function tearDown()
    {
        $di = $this->getDI();
        $di->get('modelsMetadata')->reset();

        parent::tearDown();
    }

    /**
     * Check if the test case is setup properly
     *
     * @throws \PHPUnit_Framework_IncompleteTestError;
     */
    public function __destruct()
    {
        if (!$this->_loaded) {
            throw new \PHPUnit_Framework_IncompleteTestError('Please run parent::setUp().');
        }
    }
}
