<?php
namespace Album\Model;

class Album{
    public $id;
    public $artist;
    public $title;

    public function exchangeArray($data){
        $this->id = (!empty($data['id']))?$data['id']:null;
        $this->artist = (!empty($data['artist']))?$data['artist']:null;
        $this->title = (!empty($data['title']))?$data['title']:null;
    }

    public function getArrayCopy(){
        return array(
            'id'=>$this->id,
            'title'=>$this->title,
            'artist'=>$this->artist
        );
    }
}