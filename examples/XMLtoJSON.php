<?php

require '../vendor/autoload.php';

use Kenlog\Converter;

$converter = new Converter('products.xml');
$converter->setJSON('products.json');

if ($converter->isSuccess()) {
    echo 'The XML file has been converted to JSON';
} else {
    echo 'The XML file was not converted to JSON';
}
