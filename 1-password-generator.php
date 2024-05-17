<?php
/**
 * How to run the password generator program
 * cd /code/directory/billplz-assignment
 * php 1-password-generator.php --length=12 --lowercase=true --uppercase=true --numbers=true --symbols=true
 * customize the options as per your expectation
 */

 
function generatePassword($length, $useLowerCase = true, $useUpperCase = true, $useNumbers = true, $useSymbols = true) {
    $lowerCaseChars = 'abcdefghijklmnopqrstuvwxyz';
    $upperCaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numberChars = '0123456789';
    $symbolChars = '!#$%&()*+@^';

    $chars = '';
    $password = '';

    if ($useLowerCase) {
        $chars .= $lowerCaseChars;
    }
    if ($useUpperCase) {
        $chars .= $upperCaseChars;
    }
    if ($useNumbers) {
        $chars .= $numberChars;
    }
    if ($useSymbols) {
        $chars .= $symbolChars;
    }

    $charLength = strlen($chars);

    // Check if at least one character type is selected
    if ($charLength === 0) {
        return 'No character type selected.';
    }

    // Generate password
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[rand(0, $charLength - 1)];
    }

    return $password;
}

// Command line argument parsing
$options = getopt('', ['length:', 'lowercase::', 'uppercase::', 'numbers::', 'symbols::']);

$length = isset($options['length']) ? (int)$options['length'] : 8; // Default length to 8
$useLowerCase = isset($options['lowercase']) ? filter_var($options['lowercase'], FILTER_VALIDATE_BOOLEAN) : true;
$useUpperCase = isset($options['uppercase']) ? filter_var($options['uppercase'], FILTER_VALIDATE_BOOLEAN) : true;
$useNumbers = isset($options['numbers']) ? filter_var($options['numbers'], FILTER_VALIDATE_BOOLEAN) : true;
$useSymbols = isset($options['symbols']) ? filter_var($options['symbols'], FILTER_VALIDATE_BOOLEAN) : true;

$password = generatePassword($length, $useLowerCase, $useUpperCase, $useNumbers, $useSymbols);
echo "Generated password: " . $password . PHP_EOL;
