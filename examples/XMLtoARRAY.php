<?php

require '../vendor/autoload.php';

use Kenlog\Converter;

$converter = new Converter('products.xml');
$products = $converter->getArray();

foreach ($products['Product'] as $product) {
    echo $product['Code'] . PHP_EOL;
    echo $product['Description'] . PHP_EOL;
    echo $product['Um'] . PHP_EOL;
    echo $product['Qty'] . PHP_EOL;
}
