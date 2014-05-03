<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-20 下午2:17
 */

namespace Album\Form;

use Zend\Form\Form;

class AlbumForm extends Form{

    public function __construct(){

        parent::__construct('album');

        $this->add(array(
            'name'=>'id',
            'type'=>'hidden',
            'options' => array(
                'label' => 'id',
            ),
        ));

        $this->add(array(
            'name'=>'title',
            'type'=>'text',
            'options' => array(
                'label' => 'Title',
            ),
        ));

        $this->add(array(
            'name'=>'artist',
            'type'=>'text',
            'options' => array(
                'label' => 'Artist',
            ),
        ));
        $this->add(array(
            'name'=>'submit',
            'type'=>'submit',

            'attributes'=>array(
                'value'=>'add',
            )
        ));
    }
}