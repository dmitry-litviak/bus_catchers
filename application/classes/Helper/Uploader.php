<?php
class Helper_Uploader
{
    static public function createTempIfNotExist(){
        $dir = Kohana::$config->load('config')->get('files_dir');
        if(!is_dir($dir))
            mkdir($dir, 0777);
    }

    static public function replacePlaceImage($file)
    {
        if (!$file) 
            return $file;
        
        $place_upload_dir = Kohana::$config->load('config')->get('place_dir');
        
        if(!is_dir($place_upload_dir))
            mkdir($place_upload_dir, 0777);
        
         $drop_path = explode('/', $file);
         $file_name = end($drop_path);
         $target    = $place_upload_dir.$file_name;
         rename($file, $target);
         return $file_name;
    }
    
    static public function replaceAvatarImage($file, $profile)
    {
        if (!$file) 
            return $file;
        $place_upload_dir = Kohana::$config->load('config')->get('user_files') . $profile->user->id . '/avatar/';
        
        if(!is_dir($place_upload_dir))
            mkdir($place_upload_dir, 0777, true);
        
         $drop_path = explode('/', $file);
         $file_name = end($drop_path);
         $target    = $place_upload_dir . $file_name;
         if ($target == $file) 
             return $file_name;
         $old_file = Kohana::$config->load('config')->get('user_files') . $profile->user->id . '/avatar/' . $profile->avatar;
         @unlink($old_file); 
         rename($file, $target);
         return $file_name;
    }
        
}