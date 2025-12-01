![GitHub](https://img.shields.io/github/license/kenlog/Converter?style=flat-square)
![Packagist Downloads](https://img.shields.io/packagist/dt/kenlog/converter)

# Converter :page_facing_up: :arrows_counterclockwise: :page_with_curl:
Simple converter from XML to CSV or JSON or Array.

## Requirements

- PHP >= 7.4
- ext-simplexml enabled

## Getting Started

## Install with composer

By default composer will download the latest stable version.

```bash
composer require kenlog/converter
````

## Usage – [examples](examples)

### Example conversion to CSV

```php
<?php

require 'vendor/autoload.php';

use Kenlog\Converter;

// @constructor new Converter(string $xmlFilePath);
$converterCSV = new Converter('products.xml');

// @method setCSV(string $csv, string $xpath, array $columns, string $separator = ',', int $skipLines = 0);
$success = $converterCSV->setCSV(
    'products.csv',
    '//Product',
    ['Code', 'Description', 'Um', 'Qty']
);

// you can use the return value...
if ($success) {
    echo 'The XML file has been converted to CSV' . PHP_EOL;
} else {
    echo 'The XML file was not converted to CSV' . PHP_EOL;
}

// ...or check the last operation status:
if ($converterCSV->isSuccess()) {
    // last operation was successful
}
```

### Example conversion to JSON

```php
<?php

require 'vendor/autoload.php';

use Kenlog\Converter;

// @constructor new Converter(string $xmlFilePath);
$converterJSON = new Converter('products.xml');

// @method setJSON(string $jsonFile);
if ($converterJSON->setJSON('products.json')) {
    echo 'The XML file has been converted to JSON' . PHP_EOL;
} else {
    echo 'The XML file was not converted to JSON' . PHP_EOL;
}

// Or using the status flag:
if ($converterJSON->isSuccess()) {
    // last operation was successful
}
```

### Example conversion to Array

```php
<?php

require 'vendor/autoload.php';

use Kenlog\Converter;

// @constructor new Converter(string $xmlFilePath);
$converterArray = new Converter('products.xml');

// @method getArray(): array;
$products = $converterArray->getArray();

// The result will be an array containing all records.
// Example assuming XML structure with <Product> nodes:
if (isset($products['Product']) && is_array($products['Product'])) {
    foreach ($products['Product'] as $product) {
        echo $product['Code'] . PHP_EOL;
        echo $product['Description'] . PHP_EOL;
        echo $product['Um'] . PHP_EOL;
        echo $product['Qty'] . PHP_EOL;
    }
}
```

### API Overview

```php
namespace Kenlog;

final class Converter
{
    public function __construct(string $xmlFilePath);

    public function setCSV(
        string $csv,
        string $xpath,
        array $columns,
        string $separator = ',',
        int $skipLines = 0
    ): bool;

    public function setJSON(string $jsonFile): bool;

    public function getArray(): array;

    public function isSuccess(): bool;

    public function getXml(): ?\SimpleXMLElement;
}
```

* `setCSV()`
  Converts selected XML nodes (matched by `$xpath`) to a CSV file.

  * `$columns` is the list of elements/fields to extract for each node.
  * `$skipLines` lets you skip the first N logical nodes.
* `setJSON()`
  Serializes the loaded XML to JSON and writes it to the given file.
* `getArray()`
  Converts the loaded XML to a PHP array. Returns an empty array if XML is not loaded.
* `isSuccess()`
  Returns the status of the last operation (`setCSV()` or `setJSON()`).
* `getXml()`
  Returns the underlying `SimpleXMLElement` instance or `null` if XML was not loaded.

---

## :construction_worker: Any contribution will be highly appreciated

Clone the repository:

```bash
git clone https://github.com/kenlog/converter.git
```

## :bug: Issues

Please [create an issue](https://github.com/kenlog/converter/issues) for any bugs you've found.

## Author

* **Valentino Pesce** - [Kenlog](https://github.com/kenlog)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE) file for details.
