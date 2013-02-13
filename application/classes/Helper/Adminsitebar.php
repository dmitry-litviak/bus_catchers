<?php 
class Helper_Adminsitebar
{
  
    static public $items = array();
    
    static public function init($array = array())
    {
            if(!empty($array)) {
                
                    foreach ($array as $key=>$item) {
                            $obj = new stdClass();
                            $obj->title 	= isset($item['title'])   ? $item['title']          : '';
                            $obj->url 		= isset($item['url'])     ? URL::site($item['url']) : '#';
                            $obj->status	= isset($item['status'])  ? $item['status']         : '';
                            $obj->icon          = isset($item['icon'])    ? $item['icon']           : '';
                            $obj->status        = isset($item['status'])  ? $item['status']         : 0;
                            self::addItem($key, $obj);
                    }
            }
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
            foreach (self::$items as $value) {
                  if($value->status == 1)
                    $html .= '<li class="active"><a href="'.$value->url.'"><i class="'.$value->icon.'"></i>'.$value->title.'</a></li>';
                  else
                    $html .= '<li ><a href="'.$value->url.'"><i class="'.$value->icon.'"></i>'.$value->title.'</a></li>';
            }
          echo $html;
        }
    }
}

?>