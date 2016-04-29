<?php

namespace MicheleAngioni\PhalconValidators\Tests;

use Phalcon\Validation;

class ValidatorsTest extends TestCase
{
    public function testIpValidatorOk()
    {
        $data['ip'] = '192.168.0.1';

        $validation = new Validation();

        $validation->add(
            'ip',
            new \MicheleAngioni\PhalconValidators\IpValidator (
                [
                    'message' => 'The IP is not valid.'
                ]
            )
        );

        $messages = $validation->validate($data);
        $this->assertEquals(0, count($messages));
    }

    public function testIpValidatorFailing()
    {
        $data['ip'] = '192.168.0.1.1';

        $validation = new Validation();

        $validation->add(
            'ip',
            new \MicheleAngioni\PhalconValidators\IpValidator (
                [
                    'message' => 'The IP is not valid.'
                ]
            )
        );

        $messages = $validation->validate($data);
        $this->assertEquals(1, count($messages));
    }

    public function testNumericValidatorOk()
    {
        $data['number'] = 1234567890;

        $validation = new Validation();

        $validation->add(
            'number',
            new \MicheleAngioni\PhalconValidators\NumericValidator (
                [
                    'min' => 1,                                                     // Optional
                    'max' => 2000000000,                                            // Optional
                    'message' => 'Only numeric (0-9) characters are allowed.',      // Optional
                    'messageMinimum' => 'The value must be at least 1',             // Optional
                    'messageMaximum' => 'The value must be lower than 12345678900'  // Optional
                ]
            )
        );

        $messages = $validation->validate($data);
        $this->assertEquals(0, count($messages));
    }

    public function testNumericValidatorFailingMax()
    {
        $data['number'] = 1234567890;

        $validation = new Validation();

        $validation->add(
            'number',
            new \MicheleAngioni\PhalconValidators\NumericValidator (
                [
                    'min' => 2,                                                     // Optional
                    'max' => 10         ,                                           // Optional
                    'message' => 'Only numeric (0-9) characters are allowed.',      // Optional
                    'messageMinimum' => 'The value must be at least 2',             // Optional
                    'messageMaximum' => 'The value must be lower than 10'           // Optional
                ]
            )
        );

        $messages = $validation->validate($data);
        $this->assertEquals(1, count($messages));
    }

    public function testNumericValidatorFailingMin()
    {
        $data['number'] = 1;

        $validation = new Validation();

        $validation->add(
            'number',
            new \MicheleAngioni\PhalconValidators\NumericValidator (
                [
                    'min' => 2,                                                     // Optional
                    'max' => 10         ,                                           // Optional
                    'message' => 'Only numeric (0-9) characters are allowed.',      // Optional
                    'messageMinimum' => 'The value must be at least 2',             // Optional
                    'messageMaximum' => 'The value must be lower than 10'           // Optional
                ]
            )
        );

        $messages = $validation->validate($data);
        $this->assertEquals(1, count($messages));
    }

    public function testAlphaNumericValidatorOk()
    {
        $data['text'] = '0123456789 abcdefghijklmnopqrstuvz ñ _';

        $validation = new Validation();

        $validation->add(
            'text',
            new \MicheleAngioni\PhalconValidators\AlphaNumericValidator (
                [
                    'whiteSpace' => true,                                                       // Optional, default false
                    'underscore' => true,                                                       // Optional, default false
                    'min' => 5,                                                                 // Optional
                    'max' => 100,                                                               // Optional
                    'message' => 'Validation failed.',                                          // Optional
                    'messageMinimum' => 'The value must contain at least 5 characters.',        // Optional
                    'messageMaximum' => 'The value can contain maximum 100 characters.'         // Optional
                ]
            )
        );

        $messages = $validation->validate($data);
        $this->assertEquals(0, count($messages));
    }

    public function testNamesValidatorOk()
    {
        /*
        $data['text'] = 'Richard Feynman _';

        $validation = new Validation();

        $validation->add(
            'text',
            new \MicheleAngioni\PhalconValidators\AlphaNamesValidator (
                [
                    'numbers' => true,                                                          // Optional, default false
                    'min' => 5,                                                                 // Optional
                    'max' => 100,                                                               // Optional
                    'message' => 'Validation failed.',                                          // Optional
                    'messageMinimum' => 'The value must contain at least 5 characters.',        // Optional
                    'messageMaximum' => 'The value can contain maximum 100 characters.'         // Optional
                ]
            )
        );

        $messages = $validation->validate($data);

        foreach($messages as $message) {
            var_dump($message);
        }

        $this->assertEquals(0, count($messages));
        */
    }

}
