<?php 

use Kenlog\Converter;

class ConverterTest extends \Codeception\Test\Unit
{
    // tests
    public function testConversionCSV1()
    {
        $converter = new Converter('tests/_data/products.xml');
        $converter->setCSV('tests/_output/testConversionCSV1.csv', '//Product',['Code', 'Description', 'Um', 'Qty'],';');
        $this->assertTrue($converter->isSuccess());
    }

    public function testConversionCSV2()
    {
        $converter = new Converter('tests/_data/products.xml');
        $converter->setCSV('tests/_output/testConversionCSV2.csv','//Product',['Code','Qty']);
        $this->assertTrue($converter->isSuccess());
    }

    public function testConversionCSV3()
    {
        $converter = new Converter('tests/_data/products.xml');
        $converter->setCSV('tests/_output/testConversionCSV3.csv','//Product',['Code','Qty'],',',2);
        $this->assertTrue($converter->isSuccess());
    }

    public function testConversionJSON()
    {
        $converter = new Converter('tests/_data/products.xml');
        $converter->setJSON('tests/_output/testConversionJSON.json');
        $this->assertTrue($converter->isSuccess());
    }

    public function testConversionArray()
    {
        $converter = new Converter('tests/_data/products.xml');
        $products = $converter->getArray();
        $this->assertContains($products['Product'], $products);
    }

}
