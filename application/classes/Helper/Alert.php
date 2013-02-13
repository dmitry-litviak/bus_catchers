<?php
class Helper_Alert
{
        static private $_status  = 'success';
        static private $_strong  = 'Well done!';
        static private $_message = '';


        static public function setStatus($status)
        {
            self::$_status = $status;
            
            switch ($status){
              case ('success'):
                self::$_strong = 'Well done!'; break;
              case ('error'):
                self::$_strong = 'Oh snap!'  ; break;
              case ('info'):
                self::$_strong = 'Heads up!' ; break;
              default :
                self::$_strong = 'Well done!'; break;
            }
        }

        static public function get_flash()
        {         $message = Session::instance()->get_once('message');
                  if(!empty($message))
                    echo $message;
        }

        static public function set_flash($message)
        {
            if(is_array($message))
                self::$_message = array_shift($message);
            else
                self::$_message = $message;
            
            Session::instance()->set('message', self::_build_message());
        }
        
        static private function _build_message(){
            return '<div class="alert alert-'.self::$_status.'"><button type="button" class="close" data-dismiss="alert">×</button><strong>'.self::$_strong.'</strong> '.self::$_message.'</div>';
        }
}
?>
