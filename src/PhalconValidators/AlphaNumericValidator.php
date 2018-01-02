<?php

namespace MicheleAngioni\PhalconValidators;

use Phalcon\Validation;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;
use Phalcon\Validation\ValidatorInterface;

class AlphaNumericValidator extends Validator implements ValidatorInterface
{
    /**
     * Executes the validation. Allowed options:
     * 'whiteSpace' : allow white spaces;
     * 'underscore' : allow underscores;
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

        $whiteSpace = (bool)$this->getOption('whiteSpace');
        $whiteSpace = $whiteSpace ? '\s' : '';

        $underscore = (bool)$this->getOption('underscore');
        $underscore = $underscore ? '_' : '';

        $minus = (bool)$this->getOption('minus');
        $minus = $minus ? '-' : '';

        if (!preg_match('/^([\p{L}0-9' . $whiteSpace . $underscore . $minus . '])+$/u', $value)) {
            $message = $this->getOption('message');

            if (!$message) {
                $message = 'The value can contain only alphanumeric';

                if ($whiteSpace) {
                    $message .= ', spaces';
                }

                if ($underscore) {
                    $message .= ', underscores';
                }

                if ($minus) {
                    $message .= ', minuses';
                }

                $message .= ' characters.';
            }

            $validator->appendMessage(new Message($message, $attribute, 'AlphaNumeric'));
        }

        if ($min = (int)$this->getOption('min')) {
            if (strlen($value) < $min) {
                $messageMin = $this->getOption(
                    'messageMinimum',
                    'The value must contain at least ' . $min . ' characters.'
                );

                $validator->appendMessage(new Message($messageMin, $attribute, 'AlphaNumeric'));
            }
        }

        if ($max = (int)$this->getOption('max')) {
            if (strlen($value) > $max) {
                $messageMax = $this->getOption(
                    'messageMaximum',
                    'The value can contain maximum ' . $max . ' characters.'
                );

                $validator->appendMessage(new Message($messageMax, $attribute, 'AlphaNumeric'));
            }
        }

        if (count($validator->getMessages())) {
            return false;
        }

        return true;
    }
}
