# Phalcon Validators

## Introduction

Phalcon Validators adds several new validators to the few default ones present in Phalcon 2.
 
## Installation

Support can be installed through Composer, just include `"michele-angioni/phalcon-validators": "dev-master"` to your composer.json and run `composer update` or `composer install`.

## Usage

The new validators work in the same way the default validators do. 
Just pass a new instance of the validator to the Phalcon `Validation` class, with the desired options, and then validate it.
 
Available validators with practical example:

### IpValidator

The IpValidator validates a valid ip address.

        $data['ip'] = $this->request->getPost('ip');

        $validation = new Phalcon\Validation();

        $validation->add(
            'ip',
            new MicheleAngioni\PhalconValidators\IpValidator (
                [
                    'message' => 'The IP is not valid.'       // Optional
                ]
            )
        );

        $messages = $validation->validate($data);

        if (count($messages)) {
            // Some error occurred, handle messages
            
        }
        
        // Validation succeeded without errors

### NumericValidator

The NumericValidator only allows for numeric (i.e. 0-9) characters.
Minimum and maximum values can be specified.

        $data['number'] = $this->request->getPost('number');

        $validation = new Phalcon\Validation();

        $validation->add(
            'number',
            new MicheleAngioni\PhalconValidators\NumericValidator (
                [
                    'min' => 2,                                                     // Optional
                    'max' => 50,                                                    // Optional     
                    'message' => 'Only numeric (0-9) characters are allowed.',      // Optional
                    'messageMinimum' => 'The value must be at least 2',             // Optional
                    'messageMaximum' => 'The value must be lower than 50'           // Optional
                ]
            )
        );

        $messages = $validation->validate($data);

        if (count($messages)) {
            // Some error occurred, handle messages
            
        }
        
        // Validation succeeded without errors
        
### AlphaNumericValidator

The AlphaNumericValidator allows for alphanumeric characters. Optionally, it can allow underscores and white spaces.
Minimum and maximum string lengths can be specified.

        $data['text'] = $this->request->getPost('text');

        $validation = new Phalcon\Validation();

        $validation->add(
            'text',
            new MicheleAngioni\PhalconValidators\AlphaNumericValidator (
                [
                    'whiteSpace' => true,                                                       // Optional, default false
                    'underscore' => true,                                                       // Optional, default false
                    'min' => 6,                                                                 // Optional
                    'max' => 30,                                                                // Optional     
                    'message' => 'Validation failed.',                                          // Optional
                    'messageMinimum' => 'The value must contain at least 6 characters.',        // Optional
                    'messageMaximum' => 'The value can contain maximum 30 characters.'          // Optional
                ]
            )
        );

        $messages = $validation->validate($data);

        if (count($messages)) {
            // Some error occurred, handle messages
            
        }
        
        // Validation succeeded without errors

### AlphaNamesValidator

The AlphaNamesValidator allows for alphabetic, menus, apostrophe, underscore and white space characters. 
Optionally, it can allow also numbers (i.t. 0-9).
Minimum and maximum string lengths can be specified.

        $data['text'] = $this->request->getPost('text');

        $validation = new Phalcon\Validation();

        $validation->add(
            'text',
            new MicheleAngioni\PhalconValidators\AlphaNamesValidator (
                [
                    'numbers' => true,                                                          // Optional, default false
                    'min' => 6,                                                                 // Optional
                    'max' => 30,                                                                // Optional     
                    'message' => 'Validation failed.',                                          // Optional
                    'messageMinimum' => 'The value must contain at least 6 characters.',        // Optional
                    'messageMaximum' => 'The value can contain maximum 30 characters.'          // Optional
                ]
            )
        );

        $messages = $validation->validate($data);

        if (count($messages)) {
            // Some error occurred, handle messages
            
        }
        
        // Validation succeeded without errors

### AlphaCompleteValidator

The AlphaCompleteValidator allows for alphanumeric, underscore, white space, slash, apostrophe, round and square brackets/parentheses and punctuation characters. 
Minimum and maximum string lengths can be specified.

        $data['text'] = $this->request->getPost('text');

        $validation = new Phalcon\Validation();

        $validation->add(
            'text',
            new MicheleAngioni\PhalconValidators\AlphaCompleteValidator (
                [
                    'min' => 6,                                                                 // Optional
                    'max' => 30,                                                                // Optional     
                    'message' => 'Validation failed.',                                          // Optional
                    'messageMinimum' => 'The value must contain at least 6 characters.',        // Optional
                    'messageMaximum' => 'The value can contain maximum 30 characters.'          // Optional
                ]
            )
        );

        $messages = $validation->validate($data);

        if (count($messages)) {
            // Some error occurred, handle messages
            
        }
        
        // Validation succeeded without errors
        
## Contribution guidelines

Phalcon Validators follows PSR-1, PSR-2 and PSR-4 PHP coding standards, and semantic versioning.

Pull requests are welcome.

## License

Phalcon Validators is free software distributed under the terms of the MIT license.
