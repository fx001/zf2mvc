<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-26 下午3:15
 */

namespace KpUser\InputFilter;

use KpUser\Model\UserModel;
use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\InputFilter\InputFilter;


class UserBaseInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'username',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StringTrim'
                ),
                array(
                    'name' => 'HtmlEntities'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'min' => 6,
                        'max' => 20,
                    )
                ),
                array(
                    'name' => 'Db\NoRecordExists',
                    'options' => array(
                        'table' => 'kp_user',
                        'field' => 'username',
                        'adapter' => GlobalAdapterFeature::getStaticAdapter()
                    )
                ),

            )
        ));

        $this->add(array(
            'name' => 'password',
            'required' => false,
            'filters' => array(
                array(
                    'name' => 'StringTrim'
                ),
                array(
                    'name' => 'callback',
                    'options' => array(
                        'callback' => function ($password) {
                                if (!empty($password)) {
                                    return UserModel::encryption($password);
                                }
                                return $password;
                            }
                    )
                )
            ),

        ));
    }
}