<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 21.01.2017
 * Time: 20:03
 */

namespace UserBundle;


use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}