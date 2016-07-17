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

    public function testNumericValidatorOkSign()
    {
        $data['number'] = -10;

        $validation = new Validation();

        $validation->add(
            'number',
            new \MicheleAngioni\PhalconValidators\NumericValidator (
                [
                    'allowSign' => true,                                            // Optional, default false
                    'min' => -20,                                                   // Optional
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

    public function testNumericValidatorFailingSign()
    {
        $data['number'] = -10;

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

    public function testNumericValidatorFailingComma()
    {
        $data['number'] = 5.3;

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

    public function testNumericValidatorFloatOk()
    {
        $data['number'] = 5.3;

        $validation = new Validation();

        $validation->add(
            'number',
            new \MicheleAngioni\PhalconValidators\NumericValidator (
                [
                    'allowFloat' => true,                                           // Optional, default: false
                    'min' => 2,                                                     // Optional
                    'max' => 10         ,                                           // Optional
                    'message' => 'Only numeric (0-9) characters are allowed.',      // Optional
                    'messageMinimum' => 'The value must be at least 2',             // Optional
                    'messageMaximum' => 'The value must be lower than 10'           // Optional
                ]
            )
        );

        $messages = $validation->validate($data);
        $this->assertEquals(0, count($messages));
    }

    public function testNumericValidatorFloatOkSignPlus()
    {
        $data['number'] = +5.3;

        $validation = new Validation();

        $validation->add(
            'number',
            new \MicheleAngioni\PhalconValidators\NumericValidator (
                [
                    'allowSign' => true,                                           // Optional, default: false
                    'allowFloat' => true,                                           // Optional, default: false
                    'max' => 10         ,                                           // Optional
                    'message' => 'Only numeric (0-9) characters are allowed.',      // Optional
                    'messageMinimum' => 'The value must be at least 2',             // Optional
                    'messageMaximum' => 'The value must be lower than 10'           // Optional
                ]
            )
        );

        $messages = $validation->validate($data);
        $this->assertEquals(0, count($messages));
    }

    public function testNumericValidatorFloatOkSignMenus()
    {
        $data['number'] = -5.3;

        $validation = new Validation();

        $validation->add(
            'number',
            new \MicheleAngioni\PhalconValidators\NumericValidator (
                [
                    'allowSign' => true,                                           // Optional, default: false
                    'allowFloat' => true,                                           // Optional, default: false
                    'max' => 10         ,                                           // Optional
                    'message' => 'Only numeric (0-9) characters are allowed.',      // Optional
                    'messageMinimum' => 'The value must be at least 2',             // Optional
                    'messageMaximum' => 'The value must be lower than 10'           // Optional
                ]
            )
        );

        $messages = $validation->validate($data);
        $this->assertEquals(0, count($messages));
    }

    public function testNumericValidatorFloatFailing()
    {
        $data['number'] = '5.3.1';

        $validation = new Validation();

        $validation->add(
            'number',
            new \MicheleAngioni\PhalconValidators\NumericValidator (
                [
                    'allowFloat' => true,                                           // Optional, default: false
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

    public function testNumericValidatorFloatFailingSign()
    {
        $data['number'] = '-5.3.1';

        $validation = new Validation();

        $validation->add(
            'number',
            new \MicheleAngioni\PhalconValidators\NumericValidator (
                [
                    'allowFloat' => true,                                           // Optional, default: false
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

    public function testAlphaNumericValidatorFailingWhiteSpace()
    {
        $data['text'] = '0123456789 abcdefghijklmnopqrstuvz ñ _';

        $validation = new Validation();

        $validation->add(
            'text',
            new \MicheleAngioni\PhalconValidators\AlphaNumericValidator (
                [
                    'whiteSpace' => false,                                                      // Optional, default false
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
        $this->assertEquals(1, count($messages));
    }

    public function testAlphaNumericValidatorFailingUnderscope()
    {
        $data['text'] = '0123456789 abcdefghijklmnopqrstuvz ñ _';

        $validation = new Validation();

        $validation->add(
            'text',
            new \MicheleAngioni\PhalconValidators\AlphaNumericValidator (
                [
                    'whiteSpace' => true,                                                       // Optional, default false
                    'underscore' => false,                                                      // Optional, default false
                    'min' => 5,                                                                 // Optional
                    'max' => 100,                                                               // Optional
                    'message' => 'Validation failed.',                                          // Optional
                    'messageMinimum' => 'The value must contain at least 5 characters.',        // Optional
                    'messageMaximum' => 'The value can contain maximum 100 characters.'         // Optional
                ]
            )
        );

        $messages = $validation->validate($data);
        $this->assertEquals(1, count($messages));
    }

    public function testAlphaNumericValidatorFailingLength()
    {
        $data['text'] = '0123456789 abcdefghijklmnopqrstuvz ñ _';

        $validation = new Validation();

        $validation->add(
            'text',
            new \MicheleAngioni\PhalconValidators\AlphaNumericValidator (
                [
                    'whiteSpace' => true,                                                       // Optional, default false
                    'underscore' => false,                                                      // Optional, default false
                    'min' => 5,                                                                 // Optional
                    'max' => 10,                                                               // Optional
                    'message' => 'Validation failed.',                                          // Optional
                    'messageMinimum' => 'The value must contain at least 5 characters.',        // Optional
                    'messageMaximum' => 'The value can contain maximum 100 characters.'         // Optional
                ]
            )
        );

        $messages = $validation->validate($data);
        $this->assertEquals(1, count($messages));
    }

    public function testNamesValidatorOk()
    {
        $data['text'] = 'Richard Feynman';

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
        $this->assertEquals(0, count($messages));
    }

    public function testNamesValidatorOkNumbers()
    {
        $data['text'] = 'R1ch4rd F3ynm4n';

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
        $this->assertEquals(0, count($messages));
    }

    public function testNamesValidatorFailingNumbers()
    {
        $data['text'] = 'R1ch4rd F3ynm4n';

        $validation = new Validation();

        $validation->add(
            'text',
            new \MicheleAngioni\PhalconValidators\AlphaNamesValidator (
                [
                    'numbers' => false,                                                         // Optional, default false
                    'min' => 5,                                                                 // Optional
                    'max' => 100,                                                               // Optional
                    'message' => 'Validation failed.',                                          // Optional
                    'messageMinimum' => 'The value must contain at least 5 characters.',        // Optional
                    'messageMaximum' => 'The value can contain maximum 100 characters.'         // Optional
                ]
            )
        );

        $messages = $validation->validate($data);
        $this->assertEquals(1, count($messages));
    }

    public function testNamesValidatorFailingLength()
    {
        $data['text'] = 'R1ch4rd F3ynm4n';

        $validation = new Validation();

        $validation->add(
            'text',
            new \MicheleAngioni\PhalconValidators\AlphaNamesValidator (
                [
                    'numbers' => false,                                                         // Optional, default false
                    'min' => 5,                                                                 // Optional
                    'max' => 10,                                                               // Optional
                    'message' => 'Validation failed.',                                          // Optional
                    'messageMinimum' => 'The value must contain at least 5 characters.',        // Optional
                    'messageMaximum' => 'The value can contain maximum 100 characters.'         // Optional
                ]
            )
        );

        $messages = $validation->validate($data);
        $this->assertEquals(1, count($messages));
    }

    public function testNamesValidatorFailingSymbols()
    {
        $data['text'] = 'R1ch4rd F3ynm4n !';

        $validation = new Validation();

        $validation->add(
            'text',
            new \MicheleAngioni\PhalconValidators\AlphaNamesValidator (
                [
                    'numbers' => true,                                                         // Optional, default false
                    'min' => 5,                                                                 // Optional
                    'max' => 10,                                                               // Optional
                    'message' => 'Validation failed.',                                          // Optional
                    'messageMinimum' => 'The value must contain at least 5 characters.',        // Optional
                    'messageMaximum' => 'The value can contain maximum 100 characters.'         // Optional
                ]
            )
        );

        $messages = $validation->validate($data);
        $this->assertEquals(1, count($messages));
    }

    public function testAlphaCompleteValidatorOk()
    {
        $data['text'] = "0123456789 abc ñ () [] ' \" _ !? .,:;";

        $validation = new Validation();

        $validation->add(
            'text',
            new \MicheleAngioni\PhalconValidators\AlphaCompleteValidator (
                [
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

    public function testAlphaCompleteValidatorFailingSymbols()
    {
        $data['text'] = "0123456789 abc ñ () [] ' \" _ !? .,:; <";

        $validation = new Validation();

        $validation->add(
            'text',
            new \MicheleAngioni\PhalconValidators\AlphaCompleteValidator (
                [
                    'min' => 5,                                                                 // Optional
                    'max' => 100,                                                               // Optional
                    'message' => 'Validation failed.',                                          // Optional
                    'messageMinimum' => 'The value must contain at least 5 characters.',        // Optional
                    'messageMaximum' => 'The value can contain maximum 100 characters.'         // Optional
                ]
            )
        );

        $messages = $validation->validate($data);
        $this->assertEquals(1, count($messages));
    }

    public function testAlphaCompleteValidatorFailingLength()
    {
        $data['text'] = "0123456789 abc ñ () [] ' \" _ !? .,:; ";

        $validation = new Validation();

        $validation->add(
            'text',
            new \MicheleAngioni\PhalconValidators\AlphaCompleteValidator (
                [
                    'min' => 5,                                                                 // Optional
                    'max' => 10,                                                                // Optional
                    'message' => 'Validation failed.',                                          // Optional
                    'messageMinimum' => 'The value must contain at least 5 characters.',        // Optional
                    'messageMaximum' => 'The value can contain maximum 10 characters.'          // Optional
                ]
            )
        );

        $messages = $validation->validate($data);
        $this->assertEquals(1, count($messages));
    }

}
