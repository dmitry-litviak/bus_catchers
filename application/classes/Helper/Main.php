<?php
class Helper_Main
{
    static function print_flex($data = '')
    {
            echo "<pre>";
            print_r($data);
            echo "</pre>";
    }
        
    
    static function changeDateFormat($date){
      $newDate = date_parse_from_format(Kohana::$config->load('config')->get('date.format'), $date);
      return $newDate['year'].'-'.$newDate['month'].'-'.$newDate['day'];
    }
    
    static function checkExistsAndRemoveFile($file){
        if(file_exists($file)){
            @unlink ($file);
        }
    }

    static function unlinkRecursive($dir, $deleteRootToo) 
    { 
        if(!$dh = @opendir($dir)) 
            return;
        
        while (false !== ($obj = readdir($dh))) 
        { 
            if($obj == '.' || $obj == '..') 
            { 
                continue; 
            } 

            if (!@unlink($dir . '/' . $obj)) 
            { 
                self::unlinkRecursive($dir.'/'.$obj, true); 
            } 
        } 

        closedir($dh); 

        if ($deleteRootToo) 
        { 
            @rmdir($dir); 
        } 

        return; 
      }  
}
