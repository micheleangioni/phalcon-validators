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
     * @param  Validation  $validator
     * @param  string  $attribute
     *
     * @return boolean
     */
    public function validate(\Phalcon\Validation $validator, $attribute)
    {
        $value = $validator->getValue($attribute);

        if(!preg_match('/^([-\p{L}*0-9_!.,:\/;\\?&\(\)\[\]\{\}\'\"\s])+$/u', $value)) {

            $message = $this->getOption('message');

            if (!$message) {
                $message = 'The value can contain only alphanumeric, underscore, white space, slash, apostrophe, (), [] and punctuation characters';
            }

            $validator->appendMessage(new Message($message, $attribute, 'AlphaComplete'));

            return false;
        }

        if($min = $this->getOption('min')) {
            if (strlen($value) < $min) {
                return false;
            }
        }

        if($max = $this->getOption('max')) {
            if (strlen($value) > $max) {
                return false;
            }
        }

        return true;
    }
}
