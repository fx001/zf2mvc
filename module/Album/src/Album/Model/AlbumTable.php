<?php
namespace Album\Model;

use Zend\Db\TableGateway\TableGateway;

class AlbumTable{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway){
        $this->tableGateway=$tableGateway;
    }

    public function fetchAll(){
        return $this->tableGateway->select();
    }

    public function getAlbum($id){
        return $this->tableGateway->select(array('id'=>$id))->current();
    }

    public function deleteAlbum($id){
        return $this->tableGateway->delete(array('id'=>$id));
    }

    public function save(Album $album){
        $id=$album->id;
        $saveData=$album->getArrayCopy();
        if($id === null){
            $insertData=$album->getArrayCopy();
            return $this->tableGateway->insert($insertData)?$this->tableGateway->lastInsertValue:false;
        }
        return $this->tableGateway->update($saveData,array('id'=>$id));
    }
}