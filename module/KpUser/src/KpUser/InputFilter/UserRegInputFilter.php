<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-26 下午3:15
 */

namespace KpUser\InputFilter;

class UserRegInputFilter extends UserBaseInputFilter
{

    public function __construct()
    {
        parent::__construct();

        $this->add(array(
            'name' => 'password_confirm',
            'required'=>true,
            'filters' => array(
                array(
                    'name' => 'StringTrim'
                ),
            ),
            'validators' => array(
                array(
                    'name' => 'Identical',
                    'options' => array(
                        'token' => 'password'
                    )
                ),
            )
        ));

        $this->get('password')->setRequired(true);
    }
}