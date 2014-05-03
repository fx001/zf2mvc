<?php
namespace Album\Form;
use Zend\InputFilter\InputFilter;

class AlbumInputFilter extends InputFilter{
    public function __construct(){
        $this->add(array(
            'name' => 'title',
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
                        'max' => 30,
                    )
                ),

            )
        ));
    }
}