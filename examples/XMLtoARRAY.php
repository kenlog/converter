<?php 

require '../vendor/autoload.php';

use Kenlog\Converter;

// @constructor new Converter(string $xml);
$converter = new Converter('products.xml');

// @array getArray();
$products = $converter->getArray();

// The result will be an array containing all records
foreach ($products['Product'] as $product) {
    echo $product['Code'] . PHP_EOL;
    echo $product['Description']. PHP_EOL;
    echo $product['Um']. PHP_EOL;
    echo $product['Qty']. PHP_EOL;
}