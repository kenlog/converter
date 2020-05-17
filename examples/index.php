<?php 

require '../vendor/autoload.php';

use Kenlog\Converter;

$converter = new Converter('products.xml','products.csv');
$converter->setCSV('//Product',['Code', 'Description', 'Um', 'Qty']);

if ($converter->success) {
    echo 'The XML file has been converted to CSV';
} else {
    echo 'The XML file was not converted to CSV';
}