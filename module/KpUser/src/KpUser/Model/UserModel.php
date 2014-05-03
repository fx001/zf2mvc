<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-27 上午10:17
 */

namespace KpUser\Model;

class UserModel
{
    const SALT = '1=02o013lsd';
    const DEFAULT_STATUS = 1;
    const DEFAULT_TYPE = 1;
    const BAN_LOGIN_STATUS = -1;
    const BAN_LOGIN_MESSAGES = '用户禁止登录';

    public static function encryption($password)
    {
        return md5(md5($password . static::SALT));
    }
}