<?php

namespace MicheleAngioni\PhalconValidators;

use Phalcon\Validation;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;
use Phalcon\Validation\ValidatorInterface;

class AlphaNamesValidator extends Validator implements ValidatorInterface
{
    /**
     * Executes the validation. Allowed options:
     * 'numbers' : allow numbers;
     * 'min' : input value must not be shorter than it;
     * 'max' : input value must not be longer than it.
     *
     * @param  Validation $validator
     * @param  string $attribute
     *
     * @return boolean
     */
    public function validate(\Phalcon\Validation $validator, $attribute)
    {
        $value = $validator->getValue($attribute);

        $numbers = (bool)$this->getOption('numbers');
        $numbers = $numbers ? '0-9' : '';

        if (!preg_match('/^([-\p{L}' . $numbers . '\'_\s])+$/u', $value)) {

            $message = $this->getOption('message');

            if (!$message) {
                if ($numbers) {
                    $message = 'The value can contain only alphanumeric, menus, apostrophe, underscore and white space characters';
                } else {
                    $message = 'The value can contain only alphabetic, menus, apostrophe, underscore and white space characters';
                }
            }

            $validator->appendMessage(new Message($message, $attribute, 'AlphaNames'));

            return false;
        }

        if ($min = (int)$this->getOption('min')) {
            if ($value < $min) {
                $messageMin = $this->getOption('messageMinimum',
                    'The value must contain at least ' . $min . ' characters.');

                $validator->appendMessage(new Message($messageMin, $attribute, 'AlphaNames'));

                return false;
            }
        }

        if ($max = (int)$this->getOption('max')) {
            if ($value > $max) {
                $messageMax = $this->getOption('messageMaximum',
                    'The value can contain maximum ' . $max . ' characters.');

                $validator->appendMessage(new Message($messageMax, $attribute, 'AlphaNames'));

                return false;
            }
        }

        return true;
    }
}
