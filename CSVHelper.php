<?php
class CSVHelper
{
    private static $obfuscator='<?php die() ?>';
    //to-do: turn this into a class
    //we use PHP built in fgetcsv method.
    //We check a few conditions and turn blank lines into empty arrays to avoid NULLs when converting from array back to csv
    //csvToArray() takes url, reads file referenced by url and returns array
    static function read($csvFile, $offset=null, $limit=null)
    {
        if(!file_exists($csvFile))return [];
        if(!isset(PATHINFO($csvFile)['extension'])) return [];
        //If the file does not exist return false
        $file_to_read = fopen($csvFile, 'r');

        while (!feof($file_to_read)) {
            $result = fgetcsv($file_to_read, 1000, ',');
            if (array(null) !== $result) {
                $lines[] = $result;
            } else
                $lines[] = array("");

        }
        fclose($file_to_read);

        if(!isset($offset))return $lines;
        $count = 0;
        $started = false;
        $out=[];
        foreach($result as $k=>$v){
			if($k==$offset) $started=true;
			if($started){
				$out[$k]=$v;
				$count++;
				if($count==$limit) break;
			}
		}
        return $out;
    }
    //we use PHP build in method fputcsv, but it doesn't work well with empyty arrays so we use fwrite() and format our own csv instead
    //arrayToCsv() takes url, reads file referenced by url and returns array
    static function write($file, $data,$assoc=false,$overwrite=false)
    {   
        if(!isset($data))return false;

        // Open a file in write mode ('w')
        $fp = fopen($file, 'w');
        $rows=[];
        if(!$assoc){
			if(isset($data[0])) foreach($data as $row) $rows[]=$row;
			else $rows[]=$data;
		}else foreach($data as $k=>$v) $rows[$k]=$v;
        print_r($rows);
        // Loop through file pointer and a line
        foreach ($rows as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
    }

    //Takes url and index and returns the line of the file referenced by the index. File must be formated csv
    static function find($csvFile, $index)
    {
        
        $array = self::read($csvFile);
        if(!isset($array[$index]))return false;
        return $array[$index];
    }
    //adds new record in the form of a new line in a csv file
    static function newRecord($csvFile, $recordArray)
    {
        $array = self::read($csvFile);
        if ($array[0] == 0)
            $array = array($recordArray);
        else
            array_push($array, $recordArray);
        //print_r($array);
        self::write($csvFile, $array);
        return true;
    }

    //Modifies a line in a csv file
    static function modify($file, $index, $data)
    {
		if(!file_exists($file) || !isset($data) || !isset($index)) return false;
        $array = self::read($file);
        if(!isset($array[$index]))return false;
        $array[$index] = $data;
        self::write($file, $array);
        return true;
    }

    //clears a line in a csv file, line is left blank
    function clearRecord($csvFile, $index)
    {
        $array = self::read($csvFile);
        $array[$index] = array("");
        //print_r($array);
        self::write($csvFile, $array);
    }

    //deletes a line in a csv file, line is filled in with next line.
    //This is problematic if we were to delete from author as author does not have seperate index that refers to their quotes as per specification.

    static function delete($csvFile, $index)
    {

        $array = self::read($csvFile);
        unset($array[$index]); #this does not change the indexs of the array, as such, we reorder the indexes of the array as well
        $array = array_values($array);
        //print_r($array);
        self::write($csvFile, $array);
    }
    //print_r(csvToArray('./data/banned.csv'));
    //deleteRecord('quotes.csv',0);
}

?>