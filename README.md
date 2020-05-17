# Converter
Simple XML to CSV converter

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

$converter = new Converter('products.xml','products.csv');
$converter->setCSV('//Product',['Code', 'Description', 'Um', 'Qty']);

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