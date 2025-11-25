<?php
namespace App\Helpers;

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class JsonImporter
{
    public function import($jsonFile)
    {
        // Check if the file exists
        if (!file_exists($jsonFile)) {
            Log::error('File not found: ' . $jsonFile);
            return false;
        }

        // Load JSON data from the file
        $jsonData = json_decode(file_get_contents($jsonFile), true);

        // Loop through the JSON data and insert into respective tables
        foreach ($jsonData as $table => $records) {
            if (is_array($records)) {
                foreach ($records as $record) {
                    try {
                        DB::table($table)->insert($record);
                        
                    } catch (\Exception $e) {
                        Log::error('Error inserting data into ' . $table . ': ' . $e->getMessage());
                    }
                }
            }
        }

        return true;
    }


}
