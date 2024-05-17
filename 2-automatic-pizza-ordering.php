<?php
/**
 * how to run the program
 * cd to /code/directory/billplz-assignment, the run in the command line
 * php 2-automatic-pizza-ordering.php
 */

// Function to calculate the total bill
function calculateBill($pizzaSize, $pepperoni = false, $extraCheese = false) {
    $prices = [
        'small' => 15,
        'medium' => 22,
        'large' => 30
    ];

    $toppingsPrices = [
        'small' => 3,
        'medium' => 5,
        'extra_cheese' => 6
    ];

    $totalPrice = $prices[$pizzaSize];

    // Add pepperoni if selected
    if ($pepperoni) {
        $totalPrice += $toppingsPrices[$pizzaSize];
    }

    // Add extra cheese if selected
    if ($extraCheese) {
        $totalPrice += $toppingsPrices['extra_cheese'];
    }

    return $totalPrice;
}

// Function to prompt user for input and get their response
function prompt($message) {
    echo $message;
    return trim(fgets(STDIN));
}

// User input
$pizzaSize = '';
while (!in_array($pizzaSize, ['small', 'medium', 'large'])) {
    $pizzaSize = prompt("Choose pizza size (small, medium, large): ");
}

$pepperoni = '';
while (!in_array($pepperoni, ['yes', 'no'])) {
    $pepperoni = prompt("Add pepperoni? (yes or no): ");
}
$pepperoni = $pepperoni === 'yes';

$extraCheese = '';
while (!in_array($extraCheese, ['yes', 'no'])) {
    $extraCheese = prompt("Add extra cheese? (yes or no): ");
}
$extraCheese = $extraCheese === 'yes';

// Calculate final bill
$finalBill = calculateBill($pizzaSize, $pepperoni, $extraCheese);
echo "Final bill: RM " . $finalBill . PHP_EOL;


