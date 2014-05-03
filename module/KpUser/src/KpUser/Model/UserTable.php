<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-27 上午11:11
 */

namespace KpUser\Model;

use KpUser\Entity\UserEntity;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class UserTable extends AbstractTableGateway implements AdapterAwareInterface
{

    protected $table = 'kp_user';

    public function setDbAdapter(Adapter $adapter)
    {

        $this->adapter = $adapter;

        $this->resultSetPrototype = new HydratingResultSet(new ClassMethods(), new UserEntity());

        $this->initialize();
    }

    public function save(UserEntity $userEntity)
    {
        $id = (int)$userEntity->getId();

        $saveData = array_filter($this->resultSetPrototype->getHydrator()->extract($userEntity), function ($value) {
            return $value !== null;
        });

        if (!$id) {
            return $this->insert($saveData) ? $this->lastInsertValue : false;
        }

        return $this->update($saveData, array('id' => $id));
    }

    public function getOneByField($val, $field = 'id')
    {
        return $this->select(array($field => $val))->current();
    }

}