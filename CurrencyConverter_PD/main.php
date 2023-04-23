<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

use App\CurrencyConverter;

$converter = new CurrencyConverter();

echo 'Enter the amount to convert (e.g. 10.99): ';
$amount = (float)readline();

echo 'Enter the base currency (e.g. EUR): ';
$from = strtoupper(readline());

echo 'Enter the target currency (e.g. USD): ';
$to = strtoupper(readline());

try {
    $converted = $converter->convert($amount, $to);
    printf("%.2f %s = %.2f %s\n", $amount, $from, $converted, $to);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
