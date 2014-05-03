<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-5-2 下午1:08
 */

namespace KpUser\Options;

use Zend\Stdlib\AbstractOptions;

interface UserModuleOptionAwareInterface
{

    public function setUserModuleOptions(AbstractOptions $options);

    public function getUserModuleOptions();
}

