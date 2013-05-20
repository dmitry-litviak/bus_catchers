<?php
class Library_Mail {
    private $_to      = array('myfriendshane@gmail.com' => 'Shane Holland');
    private $_from    = array('myfriendshane@gmail.com' => 'Shane Holland');
    private $_subject = 'Hi';
    private $_headers = '';

    public function __construct() {
        $email_to  = ORM::factory('Setting')->getByKey("requests_email");
        $this->_to = array($email_to->value => $email_to->value2);
    }


    public static function factory(){
        return new Library_Mail();
    }

    public function setView($view, $data){
        $this->_message = View::factory($view)->set('obj', $data)->render();
        return $this;
    }
    
    public function setSubject($subject){
        $this->_subject = $subject;
        return $this;
    }
    
    public function setTo($to){
        $this->_to = $to;
        return $this;
    }
    
    public function setFrom($from){
        $this->_from = $from;
        return $this;
    }
    
    private function _prepareHeaders(){
        $this->_headers  = 'MIME-Version: 1.0' . "\r\n";
        $this->_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // Additional headers
        
        $this->_headers .= 'To: '.$this->_to[key($this->_to)].' <'.key($this->_to).'>' . "\r\n";
        $this->_headers .= 'From: '.$this->_from[key($this->_from)].' <'.key($this->_from).'>' . "\r\n";
        #$this->_headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
        #$this->_headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
    }


    public function send(){
        $this->_prepareHeaders();
        return mail($this->_to[key($this->_to)], $this->_subject, $this->_message, $this->_headers);
    }

}
?>
