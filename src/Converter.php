<?php

/**
 * This file is part of the Converter project.
 * 
 * @package     Converter
 * @author      Valentino Pesce 
 * @link        https://github.com/kenlog
 * @copyright   2020 (c) Valentino Pesce
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Kenlog;

use SimpleXMLElement;

class Converter
{
    /**
     * XML caricato
     *
     * @var \SimpleXMLElement|null
     */
    private ?SimpleXMLElement $xml = null;

    /**
     * Esito dell'ultima operazione
     *
     * @var bool
     */
    private bool $success = false;

    /**
     * @param string $xmlFilePath Percorso del file XML
     */
    public function __construct(string $xmlFilePath)
    {
        if ($xmlFilePath !== '' && is_file($xmlFilePath)) {
            $xml = simplexml_load_file($xmlFilePath);
            if ($xml instanceof SimpleXMLElement) {
                $this->xml = $xml;
            }
        }
    }

    /**
     * Esporta l'XML in CSV.
     *
     * @param  string $csv       Percorso file CSV di output
     * @param  string $xpath     XPath dei nodi da esportare
     * @param  array  $columns   Colonne/elementi da estrarre
     * @param  string $separator Separatore CSV
     * @param  int    $skipLines Numero di nodi iniziali da saltare
     * @return bool
     */
    public function setCSV(
        string $csv,
        string $xpath,
        array $columns,
        string $separator = ',',
        int $skipLines = 0
    ): bool {
        if ($this->xml === null || $csv === '' || $xpath === '' || empty($columns)) {
            return false;
        }

        $nodes = $this->xml->xpath($xpath);
        if ($nodes === false || count($nodes) === 0) {
            return false;
        }

        $handle = fopen($csv, 'w');
        if ($handle === false) {
            return false;
        }

        // Intestazione CSV
        fputcsv($handle, $columns, $separator);

        // Salta le prime $skipLines righe logiche
        if ($skipLines > 0) {
            $nodes = array_slice($nodes, $skipLines);
        }

        foreach ($nodes as $node) {
            $row = [];

            foreach ($columns as $col) {
                $value = '';

                // Prova prima come figlio diretto
                if (isset($node->{$col})) {
                    $value = trim((string) $node->{$col});
                } else {
                    // In alternativa prova con xpath relativo sul nodo
                    $result = $node->xpath($col);
                    if ($result !== false && isset($result[0])) {
                        $value = trim((string) $result[0]);
                    }
                }

                $row[] = $value;
            }

            fputcsv($handle, $row, $separator);
        }

        fclose($handle);

        return $this->success = true;
    }

    /**
     * Esporta l'XML in JSON su file.
     *
     * @param  string $jsonFile
     * @return bool
     */
    public function setJSON(string $jsonFile): bool
    {
        if ($this->xml === null || $jsonFile === '') {
            return false;
        }

        $json = json_encode(
            $this->xml,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );

        if ($json === false) {
            return false;
        }

        $bytes = file_put_contents($jsonFile, $json);
        if ($bytes === false) {
            return false;
        }

        return $this->success = true;
    }

    /**
     * Restituisce l'XML convertito in array PHP.
     *
     * @return array
     */
    public function getArray(): array
    {
        if ($this->xml === null) {
            return [];
        }

        $json = json_encode(
            $this->xml,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );

        if ($json === false) {
            return [];
        }

        $array = json_decode($json, true);

        return is_array($array) ? $array : [];
    }

    /**
     * Stato dell'ultima operazione.
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * Accesso read-only all'XML.
     *
     * @return \SimpleXMLElement|null
     */
    public function getXml(): ?SimpleXMLElement
    {
        return $this->xml;
    }
}
