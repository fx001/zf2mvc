<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-26 下午2:09
 */

namespace KpUser\Form;

use KpUser\Entity\UserEntity;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class UserBaseForm extends Form{

    public function __construct(){

        parent::__construct('user');

        $this->setHydrator(new ClassMethods())->setObject(new UserEntity());
        $this->setAttribute('class','form-horizontal');

        $this->add(array(
            'name' => 'username',
            'type' => 'text',
            'attributes'=>array(
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'username',
                'label_attributes'=>array(
                    'class'=>'col-sm-2 control-label'
                )
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'type' => 'password',
            'attributes'=>array(
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'password',
                'label_attributes'=>array(
                    'class'=>'col-sm-2 control-label'
                )
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'email',
            'attributes'=>array(
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'email',
                'label_attributes'=>array(
                    'class'=>'col-sm-2 control-label'
                )
            ),
        ));

    }


}