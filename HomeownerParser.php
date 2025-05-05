<?php

class HomeownerParser {
    private $filePath;
    private $data = [];
    private $joiners = [' and ', ' & '];

    private $data_manualReview = [];


    // ===========================
    // Setters
    // ===========================
    public function setFilePath($filePath) {
        if (!file_exists($filePath) || !is_readable($filePath)) {
            throw new InvalidArgumentException("File does not exist or is not readable: $filePath");
        }

        $this->filePath = $filePath;
    }

    public function setData($data) {
        $this->data[] = $data;
    }


    // ===========================
    // Actions
    // ===========================
    public function parse() {
        if (empty($this->filePath)) {
            throw new InvalidArgumentException("File path is not set.");
        }
        $this->parseCsv();

        $return = [
            'data' => $this->data,
            'manualReview' => $this->data_manualReview
        ];
        return $return;
    }

    private function parseCsv() {
        if (empty($this->filePath)) {
            throw new InvalidArgumentException("File path is not set.");
        }

        $handle = fopen($this->filePath, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $row = explode(',', $line);

                if($row[0] != 'homeowner') {
                    $this->nameToArray($row[0]);
                }
            }
            fclose($handle);
        } else {
            echo "Unable to open file: {$this->filePath}";
        }        
    }

    // ===========================
    // Helper Functions
    // ===========================
    private function nameToArray($name) {

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if(empty($name)) {
            return;
        }
        $isSingleName = true;
        $nameJoiner = '';
        
        // If name contains one of the joiners, split it
        foreach ($this->joiners as $joiner) {
            if (strpos($name, $joiner) !== false) {
                $isSingleName = false;    
                $nameJoiner = $joiner;
            }
        }

        if ($isSingleName) {
            $name = explode(' ', $name);

            $this->setData([
                'title' => $name[0] ?? null,
                'first_name' => $this->initialChecker($name[1] ?? null, 'first_name'),
                'initial' => $this->initialChecker($name[1] ?? null, 'initial'),
                'last_name' => $name[2] ?? null,
            ]);
        } else {
            $names = explode($nameJoiner, $name);

            foreach($names as $key => $name) {
                $names[$key] = explode(' ', $name);
            }

            if(count($names[0]) < 3 || count($names[1]) < 3) {
                // arrange them longest to shortest
                usort($names, function($a, $b) {
                    return count($b) <=> count($a);
                });

                if(count($names[0]) == 3 && count($names[1]) == 1) {    // e.g. Dr & Mr John Doe
                
                    $this->setData([
                        'title' => $names[1][0],
                        'first_name' => $this->initialChecker($names[0][1] ?? null, 'first_name'),
                        'initial' => $this->initialChecker($names[0][1] ?? null, 'initial'),
                        'last_name' => $names[0][2] ?? null,
                    ]);
                
                    $this->setData([
                        'title' => $names[0][0],
                        'first_name' => null,
                        'initial' => null,
                        'last_name' => $names[0][2] ?? null,
                    ]);
                } elseif(count($names[0]) == 2) {   // e.g. Mr & Mr Smith
                    foreach($names as $name) {
                        $this->setData([
                            'title' => $name[0] ?? null,
                            'first_name' => null,
                            'initial' => null,
                            'last_name' => $names[0][1] ?? null,
                        ]);
                    }
                } else {    // Does not meet criteria, manual review
                    $this->data_manualReview[] = $names;
                }
            } else {
                foreach($names as $name) {
                    $this->setData([
                        'title' => $name[0] ?? null,
                        'first_name' => $this->initialChecker($name[1] ?? null, 'first_name'),
                        'initial' => $this->initialChecker($name[1] ?? null, 'initial'),
                        'last_name' => $name[2] ?? null,
                    ]);
                }
            }
        }
    }

    public function initialChecker($name, $type) {
        if (empty($name)) {
            return null;
        }
        
        // Remove the .
        $name = str_replace('.', '', $name);
        
        // If it is a single character, and type is initial, return it
        if (strlen($name) == 1 && $type == 'initial') {
            return $name;
        }

        // If we want the first name, and it is more than 1 character, return it
        if(strlen($name) > 1 && $type == 'first_name') {
            return $name;
        }
    }
}
