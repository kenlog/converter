<?php 

require '../vendor/autoload.php';

use Kenlog\Converter;

// @constructor new Converter(string $xml);
$converter = new Converter('products.xml');

// @method setJSON(string $jsonFile);
$converter->setJSON('products.json');

// @var bool success
if ($converter->success) {
    echo 'The XML file has been converted to JSON';
} else {
    echo 'The XML file was not converted to JSON';
}