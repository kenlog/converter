![GitHub](https://img.shields.io/github/license/kenlog/Converter?style=flat-square)
![GitHub release (latest by date)](https://img.shields.io/github/v/release/kenlog/Converter?style=flat-square)

# Converter :page_facing_up: :arrows_counterclockwise: :page_with_curl:
Simple converter from XML to CSV or JSON or Array

## Getting Started

## Install with composer
by default composer will download the latest stable version.
```
composer require kenlog/converter
```

## Usage - [examples](examples)

### Example conversion to CSV
```php
<?php

require 'vendor/autoload.php';

use Kenlog\Converter;

// @constructor new Converter(string $xml);
$converterCSV = new Converter('products.xml');

// @method setCSV(string $csv, string $xpath, array $columns, string $separator = ',', int $skipLines = 0);
$converterCSV->setCSV('products.csv','//Product',['Code', 'Description', 'Um', 'Qty']);

// @var bool success
if ($converterCSV->success) {
    echo 'The XML file has been converted to CSV';
} else {
    echo 'The XML file was not converted to CSV';
}
```

### Example conversion to JSON
```php
<?php

require 'vendor/autoload.php';

use Kenlog\Converter;

// @constructor new Converter(string $xml);
$converterJSON = new Converter('products.xml');

// @method setJSON(string $jsonFile);
$converterJSON->setJSON('products.json');

// @var bool success
if ($converterJSON->success) {
    echo 'The XML file has been converted to JSON';
} else {
    echo 'The XML file was not converted to JSON';
}
```

### Example conversion to Array 
```php
<?php

require 'vendor/autoload.php';

use Kenlog\Converter;

// @constructor new Converter(string $xml);
$converterArray = new Converter('products.xml');

// @array getArray();
$products = $converterArray->getArray();

// The result will be an array containing all records
foreach ($products['Product'] as $product) {
    echo $product['Code'] . PHP_EOL;
    echo $product['Description'] . PHP_EOL;
    echo $product['Um'] . PHP_EOL;
    echo $product['Qty'] . PHP_EOL;
}
```

:construction_worker: Any contribution will be highly appreciated
------------
Clone the repository: 
```console 
git clone https://github.com/kenlog/converter.git
```
:bug: Issues
------------
Please [create an issue](https://github.com/kenlog/converter/issues) for any bugs you've found.

## Author

* **Valentino Pesce** - [Kenlog](https://github.com/kenlog)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE) file for details
