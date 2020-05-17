![GitHub](https://img.shields.io/github/license/kenlog/Converter?style=flat-square)
[![Latest release](https://img.shields.io/github/release/kenlog/Converter.svg)](https://github.com/kenlog/Converter/releases)

# Converter :page_facing_up: :arrows_counterclockwise: :page_with_curl:
Simple XML to CSV converter written in PHP 

## Getting Started

## Install with composer
by default composer will download the latest stable version.
```
composer require kenlog/converter
```

## Usage -> [examples](examples)
```php

<?php 

require 'vendor/autoload.php';

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

```

## Author

* **Valentino Pesce** - [Kenlog](https://github.com/kenlog)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE) file for details
