<?php 

use Kenlog\Converter;

class ConverterTest extends \Codeception\Test\Unit
{
    // tests
    public function testConversion1()
    {
        $converter = new Converter('tests/_data/products.xml','tests/_output/testConversion1.csv');
        $converter->setCSV('//Product',['Code', 'Description', 'Um', 'Qty'],';');
        $this->assertTrue($converter->success);
    }

    public function testConversion2()
    {
        $converter = new Converter('tests/_data/products.xml','tests/_output/testConversion2.csv');
        $converter->setCSV('//Product',['Code','Qty']);
        $this->assertTrue($converter->success);
    }

    public function testConversion3()
    {
        $converter = new Converter('tests/_data/products.xml','tests/_output/testConversion3.csv');
        $converter->setCSV('//Product',['Code','Qty'],',',2);
        $this->assertTrue($converter->success);
    }
}