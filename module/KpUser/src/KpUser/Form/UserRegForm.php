<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-26 下午2:33
 */

namespace KpUser\Form;

use KpUser\InputFilter\UserRegInputFilter;

class UserRegForm extends UserBaseForm
{

    public function __construct()
    {
        parent::__construct();

        $this->setInputFilter(new UserRegInputFilter());

        $this->add(array(
            'name' => 'password_confirm',
            'type' => 'password',
            'attributes'=>array(
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'password confirm',
                'label_attributes'=>array(
                    'class'=>'col-sm-2 control-label'
                )
            ),
        ));

        $this->add(array(
            'name'=>'submit',
            'type'=>'submit',
            'attributes'=>array(
                'class'=>"btn btn-default",
                'value'=>'reg',
            )
        ));
    }

}