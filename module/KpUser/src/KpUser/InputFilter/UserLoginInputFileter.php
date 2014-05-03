<?php
namespace KpUser\InputFilter;

use Zend\Validator\ValidatorChain;

class UserLoginInputFileter extends UserBaseInputFilter{
    public function __construct(){
        parent::__construct();

        $this->remove('email');
        $this->get('username')->setValidatorChain(new ValidatorChain());

    }
}