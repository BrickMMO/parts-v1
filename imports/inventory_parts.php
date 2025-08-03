<?php

ini_set('memory_limit', '512M');
set_time_limit(0);

include('../includes/connect.php');
include('../includes/config.php');
include('../includes/functions.php');

$file = 'https://cdn.rebrickable.com/media/downloads/inventory_parts.csv.gz';

$tmpGzFile = tempnam(sys_get_temp_dir(), 'inventory_parts') . '.gz';
$tmpCsvFile = str_replace('.gz', '.csv', $tmpGzFile);

file_put_contents($tmpGzFile, file_get_contents($file));

$gz = gzopen($tmpGzFile, 'rb');
$out = fopen($tmpCsvFile, 'wb');

while (!gzeof($gz)) {
    fwrite($out, gzread($gz, 4096));
}

gzclose($gz);
fclose($out);
unlink($tmpGzFile);

$file = new SplFileObject($tmpCsvFile, 'r');
$file->seek(PHP_INT_MAX);
$lastLine = $file->key();

echo 'Rows in File: ' . $lastLine . '<hr>';

for ($i = $lastLine; $i >= 0; $i--) 
{

    $file->seek($i);
    $line = trim($file->current());

    if ($line === '') continue;

    $record = str_getcsv($line);
    $record = array_map('trim', $record);

    if (count($record) === 6) 
    {

        $query = 'INSERT IGNORE INTO inventory_parts (
                inventory_id,
                part_num,
                color_id,
                quantity,
                is_spare,
                img_url
            ) VALUES (
                "' . addslashes($record[0]) . '",
                "' . addslashes($record[1]) . '",
                "' . addslashes($record[2]) . '",
                "' . addslashes($record[3]) . '",
                "' . addslashes($record[4]) . '",
                "' . addslashes($record[5]) . '"
            )';

        mysqli_query($connect, $query);

        echo 'Inserting Record<br>';
        // echo $query . '<br>';
        // echo 'Added Rows: ' . mysqli_affected_rows($connect) . '<br>';

    }
    else 
    {

        echo 'Invalid Record<br>';
        echo '<pre>';
        print_r($record);
        echo '</pre>';
        
    }

    echo '<hr>';

}

unlink($tmpCsvFile); // clean up CSV

echo 'IMPORT COMPLETE';
