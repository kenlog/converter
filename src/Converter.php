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
     * csv
     *
     * @var string
     */
    public $csv;
    
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
     * @param  string $csv
     * @return resource
     */
    public function __construct(string $xml, string $csv)
    {
        if (!empty($xml) && !empty($csv)) {
            $this->xml = simplexml_load_file($xml);
            $this->csv = $csv;
        }
    }
       
    /**
     * setCSV
     *
     * @param  string $xpath
     * @param  array $columns
     * @param  string $separator
     * @param  int $skipLines
     * @return bool
     */
    public function setCSV(string $xpath, array $columns, string $separator = ',', int $skipLines = 0)
    {
        if (isset($this->xml) && !empty($xpath) && !empty($columns))  {   
            $i = $skipLines + 1;
            $values = [];
         
            $fs = fopen($this->csv, 'w');
            fputcsv($fs, $columns, $separator);      
            fclose($fs);
        
            $node = $this->xml->xpath($xpath);
         
            foreach ($node as $n) {               
                foreach ($columns as $col) {      
                    if (count($this->xml->xpath($xpath.'['.$i.']/'.$col)) > 0) {
                        $values[] = trim($this->xml->xpath($xpath.'['.$i.']/'.$col)[0]);
                    }
                }
                
                $fs = fopen($this->csv, 'a');
                fputcsv($fs, $values, $separator);      
                fclose($fs);  
         
                $values = [];
                $i++;
            }

            return $this->success = true;
        }
    }
}