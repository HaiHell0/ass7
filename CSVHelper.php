<?php
class CSVHelper
{
    private static $obfuscator='<?php die() ?>';
    //The big idea here is to use almost he same method sigiture as those in JSONHelper example, although not with too many parameter options.
    //Hopefully we can use some polymorphism and make Entity.php super simple. 
    //all csv methods will have a different output than its json equivalent, as we can't universally represent an associative relationship in csv
    //Takes a file, and reads, optional null and offset options
    static function read($file, $offset=null, $limit=null)
    {
        if(!file_exists($file)) return [];
		if(!isset(PATHINFO($file)['extension'])) return [];
        $rows=[];
        //Reading the file 
        if(file_exists($file)) {
            $str = strtolower(PATHINFO($file)['extension'])=='php' ? trim(preg_replace('/^'.preg_quote(self::$obfuscator).'/','',file_get_contents($file))) : file_get_contents($file);
            $temp = preg_split('/\r\n|\r|\n/', $str);
            foreach($temp as $line){
                $rows[] = explode(',',$line);
            }
        };
        
        if(!isset($offset)) return $rows;
        //parcing if we have optional arguments
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

    //writes a thing, either as an append or either as overwriting, takes associative arrays as well with assoc parameter option. 
    static function write($file, $data,$assoc=false,$overwrite=false)
    {   
        if(!isset($data))return false;
        $rows=[];
        //we read the contents of the file if we do not intend to overwrite the file
        if(!$overwrite && file_exists($file)) {
            $rows = self::read($file);
        };
        //we parse assoc arrays differently 
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

    //Takes url to file and index and filter and returns an array with some element in the filter. If $filter is an array, we can specify more detail what we are looking for. 
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

    //Either turns a line into null, or completely unset the entry. 
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