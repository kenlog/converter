<?php 

require '../vendor/autoload.php';

use Kenlog\Converter;

// @constructor new Converter(string $xml);
$converter = new Converter('products.xml');

// @method setCSV(string $csv, string $xpath, array $columns, string $separator = ',', int $skipLines = 0);
$converter->setCSV('products.csv','//Product',['Code', 'Description', 'Um', 'Qty']);

// @var bool success
if ($converter->success) {
    echo 'The XML file has been converted to CSV';
} else {
    echo 'The XML file was not converted to CSV';
}