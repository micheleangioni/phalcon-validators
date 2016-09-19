<?php

namespace MicheleAngioni\PhalconValidators;

use Phalcon\Validation;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;
use Phalcon\Validation\ValidatorInterface;

class AlphaCompleteValidator extends Validator implements ValidatorInterface
{
    /**
     * Executes the validation. Allowed options:
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

        $allowPipe = (bool)$this->getOption('allowPipe');
        $allowPipe = $allowPipe ? '|' : '';

        if (!preg_match('/^([-\p{L}*0-9_+!.,:\/;' . $allowPipe . '\\?&\(\)\[\]\{\}\'\"\s])+$/u', $value)) {

            if ($allowPipe) {
                $message = $this->getOption('message',
                    'The value can contain only alphanumeric, underscore, white space, slash, pipe, apostrophe, brackets and punctuation characters');
            } else {
                $message = $this->getOption('message',
                    'The value can contain only alphanumeric, underscore, white space, slash, apostrophe, brackets and punctuation characters');
            }

            $validator->appendMessage(new Message($message, $attribute, 'AlphaComplete'));

            return false;
        }

        if ($min = (int)$this->getOption('min')) {
            if (strlen($value) < $min) {
                $messageMin = $this->getOption('messageMinimum',
                    'The value must contain at least ' . $min . ' characters.');

                $validator->appendMessage(new Message($messageMin, $attribute, 'AlphaComplete'));

                return false;
            }
        }

        if ($max = (int)$this->getOption('max')) {
            if (strlen($value) > $max) {
                $messageMax = $this->getOption('messageMaximum',
                    'The value can contain maximum ' . $max . ' characters.');

                $validator->appendMessage(new Message($messageMax, $attribute, 'AlphaComplete'));

                return false;
            }
        }

        return true;
    }
}
