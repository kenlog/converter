<?php 

require '../vendor/autoload.php';

use Kenlog\Converter;

// @constructor new Converter(string $xml, string $csv);
$converter = new Converter('products.xml','products.csv');
// @method setCSV(string $xpath, array $columns, string $separator = ',', int $skipLines = 0);
$converter->setCSV('//Product',['Code', 'Description', 'Um', 'Qty']);
// @var bool success
if ($converter->success) {
    echo 'The XML file has been converted to CSV';
} else {
    echo 'The XML file was not converted to CSV';
}