<?php
namespace KpUser\Form;

use KpUser\InputFilter\UserLoginInputFileter;

class UserLoginForm extends UserBaseForm{
    public function __construct()
    {
        parent::__construct();

        $this->setInputFilter(new UserLoginInputFileter());
        $this->remove('email');
        $this->add(array(
            'name'=>'submit',
            'type'=>'submit',
            'attributes'=>array(
                'class'=>"btn btn-default",
                'value'=>'login',
            )
        ));
    }
}