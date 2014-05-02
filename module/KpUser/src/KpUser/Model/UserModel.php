<?php
namespace KpUser\Model;
class UserModel{
    const SALT='123aa';
    public static function encryption($password){
        return md5(md5($password.static::SALT));
    }
}