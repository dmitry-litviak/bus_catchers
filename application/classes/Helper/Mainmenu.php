<?php
class Helper_Mainmenu
{
  
    static public $items   = array();
    static public $isAdmin = false;
    
    static public function init($array = array())
    {
            if(!empty($array)) {
                
                    foreach ($array as $key=>$item) {
                            $obj = new stdClass();
                            $obj->title 	= isset($item['title'])   ? $item['title']          : '';
                            $obj->url 		= isset($item['url'])     ? URL::site($item['url']) : '#';
                            $obj->status        = isset($item['status'])  ? $item['status']         : 0;
                            self::addItem($key, $obj);
                    }
            }
    }
    
    static public function setIsAdmin($flag = false){
        self::$isAdmin = $flag;
    }

    static public function addItem($index = "", stdClass $item)
    {
            if($index != "") {
                    self::$items[$index] = $item;
            }
    }
    
    
    static function setActiveItem($alias)
    {
            if(!empty(self::$items)) {
                    foreach (self::$items as $key=> $item) {
                            if($key != $alias) {
                                    self::$items[$key]->status = 0;
                            } else {
                                    self::$items[$key]->status = 1;
                            }
                    }
            }
    }
  
    public static function render(){
      if(!empty(self::$items)) {
          $html = '';
            foreach (self::$items as $key=>$value) {
                  if($key == 'admin' && !self::$isAdmin)
                      continue;
                
                  if($value->status == 1)
                    $html .= '<li class="dropdown active"><a href="'.$value->url.'">'.$value->title.'</a></li>';
                  else
                    $html .= '<li class="dropdown" ><a href="'.$value->url.'">'.$value->title.'</a></li>';
            }
          echo $html;
        }
    }
}

?>

