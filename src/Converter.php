<?php 

/**
 * This file is part of the Converter project.
 * 
 * @package     Converter
 * @author      Valentino Pesce 
 * @link        https://github.com/kenlog
 * @copyright   2020 (c) Valentino Pesce <valentino@iltuobrand.it>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Kenlog;

class Converter
{    
    /**
     * xml
     *
     * @var string
     */
    public $xml;
    
    /**
     * success
     *
     * @var bool
     */
    public $success = false;
    
        
    /**
     * __construct
     *
     * @param  string $xml
     * @return resource
     */
    public function __construct(string $xml)
    {
        if (!empty($xml)) {
            $this->xml = simplexml_load_file($xml);
        }
    }
       
    /**
     * setCSV
     *
     * @param  string $csv
     * @param  string $xpath
     * @param  array $columns
     * @param  string $separator
     * @param  int $skipLines
     * @return bool
     */
    public function setCSV(string $csv, string $xpath, array $columns, string $separator = ',', int $skipLines = 0)
    {
        if (isset($this->xml, $csv) && !empty($xpath) && !empty($columns))  {  
            $i = $skipLines + 1;
            $values = [];
         
            $fs = fopen($csv, 'w');
            fputcsv($fs, $columns, $separator);      
            fclose($fs);
        
            $node = $this->xml->xpath($xpath);
         
            foreach ($node as $n) {               
                foreach ($columns as $col) {      
                    if (count($this->xml->xpath($xpath.'['.$i.']/'.$col)) > 0) {
                        $values[] = trim($this->xml->xpath($xpath.'['.$i.']/'.$col)[0]);
                    }
                }
                
                $fs = fopen($csv, 'a');
                fputcsv($fs, $values, $separator);      
                fclose($fs);  
         
                $values = [];
                $i++;
            }

            return $this->success = true;
        }
    }
    
    /**
     * setJSON
     *
     * @param  string $jsonFile
     * @return bool
     */
    public function setJSON(string $jsonFile)
    {
        if (isset($this->xml) && !empty($jsonFile)) {
            $json = json_encode($this->xml);
            json_decode(file_put_contents($jsonFile,$json),true);
            $this->success = true;
        }
    }
    
    /**
     * getArray
     *
     * @return array
     */
    public function getArray()
    {
        if (isset($this->xml)) {
            return json_decode(json_encode((array)$this->xml), 1);
        }
    }
}