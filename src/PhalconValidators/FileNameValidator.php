<?php

namespace MicheleAngioni\PhalconValidators;

use Phalcon\Validation;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;
use Phalcon\Validation\ValidatorInterface;

class FileNameValidator extends Validator implements ValidatorInterface
{
    /**
     * Executes the validation. Allowed options:
     * 'min' : input value must not be shorter than it;
     * 'max' : input value must not be longer than it;
     * 'allowMultipleDots' : allow multiple dots;
     * 'allowAllLatin' : allow all latin characters;
     * 'allowSpaces' : allow spaces.
     *
     * @param  Validation $validator
     * @param  string $attribute
     *
     * @return boolean
     */
    public function validate(\Phalcon\Validation $validator, $attribute)
    {
        $value = $validator->getValue($attribute);

        $allowMultipleDots = (bool)$this->getOption('allowMultipleDots');
        $allowMultipleDots= $allowMultipleDots ? '+' : '';

        $allowAllLatin = (bool)$this->getOption('allowAllLatin');
        $allowAllLatin = $allowAllLatin ? '\p{L}' : 'a-zA-Z';

        $allowSpaces = (bool)$this->getOption('allowSpaces');
        $allowSpaces = $allowSpaces ? '\s' : '';

        $namePart = '[' . $allowAllLatin . $allowSpaces . '0-9_-]';

        if (!preg_match('/^(' . $namePart . '+\.{1}' . $namePart . '+)' . $allowMultipleDots . '$/u', $value)) {
            if ($allowAllLatin) {
                $charMessage = 'simple letters';
            } else {
                $charMessage = 'letters';
            }

            $message = 'The value must be a valid file name, including extension, and can contain only '
                . $charMessage . ', numbers, underscores, minuses';

            if ($allowMultipleDots) {
                $message .= ', dots';
            }

            if ($allowSpaces) {
                $message .= ', spaces';
            }

            $message = $this->getOption('message', $message);

            $validator->appendMessage(new Message($message, $attribute, 'FileName'));
        }

        if ($min = (int)$this->getOption('min')) {
            if (strlen($value) < $min) {
                $messageMin = $this->getOption(
                    'messageMinimum',
                    'The value must contain at least ' . $min . ' characters.'
                );

                $validator->appendMessage(new Message($messageMin, $attribute, 'FileName'));
            }
        }

        if ($max = (int)$this->getOption('max')) {
            if (strlen($value) > $max) {
                $messageMax = $this->getOption(
                    'messageMaximum',
                    'The value can contain maximum ' . $max . ' characters.'
                );

                $validator->appendMessage(new Message($messageMax, $attribute, 'FileName'));
            }
        }

        if (count($validator->getMessages())) {
            return false;
        }

        return true;
    }
}
