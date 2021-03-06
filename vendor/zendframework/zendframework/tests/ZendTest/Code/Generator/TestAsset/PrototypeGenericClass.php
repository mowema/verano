<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZendTest\Code\Generator\TestAsset;

use Zend\Code\Generic\Prototype\PrototypeGenericInterface;

class PrototypeGenericClass implements PrototypeGenericInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'default';
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
    }


}
