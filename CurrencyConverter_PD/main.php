<?php


require_once 'vendor/autoload.php';

use CurrencyConverter_PD\app\CurrencyConverter;

$converter = new CurrencyConverter();


// Read user input
echo 'Enter the amount to convert (e.g. 10.99): ';
$amount = (float)readline();

echo 'Enter the base currency (e.g. EUR): ';
$from = strtoupper(readline());

echo 'Enter the target currency (e.g. USD): ';
$to = strtoupper(readline());

// Convert the amount
try {
    $rate = $converter->getExchangeRate($from, $to);
    $converted = $amount * $rate;
    printf("%.2f %s = %.2f %s\n", $amount, $from, $converted, $to);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}


