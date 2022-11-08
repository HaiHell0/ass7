<?php
class CSVHelper
{
    private static $obfuscator='<?php die() ?>';
    //to-do: turn this into a class
    //we use PHP built in fgetcsv method.
    //We check a few conditions and turn blank lines into empty arrays to avoid NULLs when converting from array back to csv
    //csvToArray() takes url, reads file referenced by url and returns array
    static function read($file, $offset=null, $limit=null)
    {
        if(!file_exists($file)) return [];
		if(!isset(PATHINFO($file)['extension'])) return [];
        $rows=[];
        //we read the contents of the file if we do not intend to overwrite the file


        

        if(file_exists($file)) {
            $str = strtolower(PATHINFO($file)['extension'])=='php' ? trim(preg_replace('/^'.preg_quote(self::$obfuscator).'/','',file_get_contents($file))) : file_get_contents($file);
            $temp = preg_split('/\r\n|\r|\n/', $str);
            foreach($temp as $line){
                $rows[] = explode(',',$line);
            }
        };

        if(!isset($offset)) return $rows;
		$count=0;
		$started=false;
		$out=[];
        foreach($rows as $k=>$v){
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
        $rows=[];
        //we read the contents of the file if we do not intend to overwrite the file
        if(!$overwrite && file_exists($file)) {
            $rows = self::read($file);
        };
        
        if(!$assoc){
			if(isset($data[0])) foreach($data as $row1) array_push($rows,$row1);
			else array_push($rows,$data);
		}else foreach($data as $k=>$v) $rows[]=$v;

        $fp = fopen($file, 'w+');
        if(!flock($fp,LOCK_EX|LOCK_NB)) return false;
        if(strtolower(PATHINFO($file)['extension'])=='php') fwrite($fp,self::$obfuscator."\n");
        // Loop through file pointer and a line
        foreach ($rows as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
    }

    //Takes url and index and returns the line of the file referenced by the index. File must be formated csv
    static function find($file, $filter,$limit=null)
    {
        if(!file_exists($file)) return [];
		$records=self::read($file);
		$count=0;
		$out=[];
		foreach($records as $record){
            //print_r($record);
            if(is_array($filter)){
                $found = true;
                foreach($filter as $k =>$v)if(!isset($record[$k])||$record[$k]!=$v)$found = false;
                if($found) $out[$count]=$record;
                
            }else foreach($record as $k=>$v) if($v==$filter) $out[$count]=$record;
            if($limit!=null &&$count>=$limit)break;
            $count++;
        }return $out;
    }

    //Modifies a line in a csv file
    static function modify($file,$index,$data,$overwrite=true)
    {
		if(!file_exists($file) || !isset($data) || !isset($index)) return false;
		$rows=self::read($file);
		if(!isset($rows[$index])) return false;
		$rows[$index]=$overwrite ? $data : array_merge($rows[$index],$data);

		if(!flock($h=fopen($file,'w+'),LOCK_EX|LOCK_NB)) return false;
		if(strtolower(PATHINFO($file)['extension'])=='php') fwrite($h,self::$obfuscator."\n");
		  foreach ($rows as $fields) {
            fputcsv($h, $fields);
        }
        fclose($h);
    }


    static function delete($file,$index=null,$assoc=false,$wipe=false)
    {
		if(!file_exists($file)) return false;
		if(!isset($index)) return unlink($file);
		$rows=self::read($file);

		if(is_array($index)){
			foreach($index as $i){
				if($wipe) unset($rows[$i]); 
				else $rows[$i]=array("null");
			}
		}else{
			if($wipe) unset($rows[$index]);
			else $rows[$index]=array("null");
		}
        print_r($rows);
		if(!$assoc) $rows=array_values($rows);
		if(!flock($h=fopen($file,'w+'),LOCK_EX|LOCK_NB)) return false;
		if(strtolower(PATHINFO($file)['extension'])=='php') fwrite($h,self::$obfuscator."\n");

        foreach ($rows as $fields) {
            fputcsv($h, $fields);
            print_r($fields);
        }
		fclose($h);
		return true;
    }

}

?>