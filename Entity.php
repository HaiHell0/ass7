<?php
    require("CSVHelper.php");
    require("JSONHelper.php");
    class Entity{
        static function read($file, $offset=null, $limit=null){
            
            
            if(str_contains($file,'.csv')){
          
                return CSVHelper::read($file, $offset, $limit);
            }
            if(str_contains($file,'.json')){
                return JSONHelper::read($file, $offset, $limit);
            }
        }
        static function write($file, $data,$assoc=false,$overwrite=false){
            
            if(str_contains($file,'.csv')){
                return CSVHelper::write($file, $data,$assoc,$overwrite);
            }
            if(str_contains($file,'.json')){
                return JSONHelper::write($file, $data,$assoc,$overwrite);
            }
        }
        static function find($file, $filter,$limit=null){
            
            if(str_contains($file,'.csv')){
                return CSVHelper::find($file, $filter,$limit);
            }
            if(str_contains($file,'.json')){
                return JSONHelper::find($file, $filter,$limit);
            }
        }
        static function modify($file,$index,$data,$overwrite=true){
            
            if(str_contains($file,'.csv')){
                return CSVHelper::modify($file,$index,$data,$overwrite);
            }
            if(str_contains($file,'.json')){
                return JSONHelper::modify($file,$index,$data,$overwrite);
            }
        }
        static function delete($file,$index=null,$assoc=false,$wipe=false){
            
            if(str_contains($file,'.csv')){
                return CSVHelper::delete($file,$index,$assoc,$wipe);
            }
            if(str_contains($file,'.json')){
                return JSONHelper::delete($file,$index,$assoc,$wipe);
            }
        }
    
    }




?>