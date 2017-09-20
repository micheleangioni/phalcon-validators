# Phalcon Validators

[![License](https://poser.pugx.org/michele-angioni/phalcon-validators/license)](https://packagist.org/packages/michele-angioni/phalcon-validators)
[![Latest Stable Version](https://poser.pugx.org/michele-angioni/phalcon-validators/v/stable)](https://packagist.org/packages/michele-angioni/phalcon-validators)
[![Latest Unstable Version](https://poser.pugx.org/michele-angioni/phalcon-validators/v/unstable)](https://packagist.org/packages/michele-angioni/phalcon-validators)
[![Build Status](https://travis-ci.org/micheleangioni/phalcon-validators.svg)](https://travis-ci.org/micheleangioni/phalcon-validators)


## Introduction

Phalcon Validators adds several new validators to the few default ones present in Phalcon 2.
 
## Installation

Support can be installed through Composer, just include `"michele-angioni/phalcon-validators": "~1.7"` to your composer.json and run `composer update` or `composer install`.

## Usage

The new validators work in the same way the default validators do. 
Just pass a new instance of the validator to the Phalcon `Validation` class, with the desired options, and then validate it.
 
Available validators with practical example:

### IpValidator

The IpValidator validates a valid ip address.

```php
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
```

// Validation succeeded without errors

### NumericValidator

The default NumericValidator only allows for numeric (i.e. 0-9) characters.
Minimum and maximum values can be specified.

Optionally, it can support float values, that is allowing a dot (.) character to separate decimals.

Optionally also signed numbers are supported.

```php
$data['number'] = $this->request->getPost('number');

$validation = new Phalcon\Validation();

$validation->add(
    'number',
    new MicheleAngioni\PhalconValidators\NumericValidator (
        [
            'allowFloat' => true,                                           // Optional, default: false
            'allowSign' => true,                                            // Optional, default: false
            'min' => 2,                                                     // Optional
            'min' => 2,                                                     // Optional
            'max' => 50,                                                    // Optional
            'message' => 'Only numeric (0-9,.) characters are allowed.',    // Optional
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
```
        
### AlphaNumericValidator

The AlphaNumericValidator allows for alphanumeric characters. Optionally, it can allow underscores, minuses and white spaces.
Minimum and maximum string lengths can be specified.

```php
$data['text'] = $this->request->getPost('text');

$validation = new Phalcon\Validation();

$validation->add(
    'text',
    new MicheleAngioni\PhalconValidators\AlphaNumericValidator (
        [
            'whiteSpace' => true,                                                       // Optional, default false
            'underscore' => true,                                                       // Optional, default false
            'minus' => true,                                                            // Optional, default false
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
```

### AlphaNamesValidator

The AlphaNamesValidator allows for alphabetic, menus, apostrophe, underscore and white space characters. 
Optionally, it can allow also numbers (i.t. 0-9).
Minimum and maximum string lengths can be specified.

```php
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
```

### AlphaCompleteValidator

The AlphaCompleteValidator allows for alphanumeric, underscore, white space, slash, apostrophe, round and square brackets/parentheses and punctuation characters.
Optionally, it can allow also pipes (|), ATs (@), backslashes (\), percentages (%) and Url Characters (equals (=) and hashtags (#)).
Minimum and maximum string lengths can be specified.

```php
$data['text'] = $this->request->getPost('text');

$validation = new Phalcon\Validation();

$validation->add(
    'text',
    new MicheleAngioni\PhalconValidators\AlphaCompleteValidator (
        [
            'allowBackslashes' => true,                                                 // Optional
            'allowAt' => true,                                                          // Optional
            'allowPipes' => true,                                                       // Optional
            'allowPercentages' => true,                                                 // Optional
            'allowUrlChars' => true,                                                    // Optional
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
```
        
## Contribution guidelines

Phalcon Validators follows PSR-1, PSR-2 and PSR-4 PHP coding standards, and semantic versioning.

Pull requests are welcome.

## License

Phalcon Validators is free software distributed under the terms of the MIT license.
