<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_User_Profile extends ORM {

    // Relationships
    protected $_has_one = array(
            'user' => array('model' => 'User'),
    );
    
    public function rules()
    {
            return array(
                    'first_name' => array(
                            array('not_empty'),
                    ),
                    'last_name' => array(
                            array('not_empty'),
                    ),
            );
    }
    
    public function filters()
    {
            return array(
                'p_issue_date' => array(
                    array('strtotime')
                ),
                'p_expiry_date' => array(
                    array('strtotime')
                ),
                'avatar'=> array(
                        array('Helper_Uploader::replaceAvatarImage', array(':value', ':model')),
                ),
                'dob'=> array(
                        array('Helper_Output::timestampForDB'),
                ),
            );
    }
        
    public function create_profile($values, $expected)
    {
        $extra_validation = self::get_validation($values);
        return $this->values($values, $expected)->create($extra_validation);
    }
    
    public function update_profile($values, $expected = NULL, $id)
    {
        $profile = $this->where('id', '=', $id)->find()->values($values, $expected)->update();
    }
    
    public static function get_validation($values)
    {
        $validate = Validation::factory($values);
        $validate->rule('first_name', 'not_empty')
                 ->rule('last_name', 'not_empty')
                ;
        return $validate;
    }
    
    
}