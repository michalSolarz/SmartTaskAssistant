<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 21.03.15
 * Time: 13:59
 */

namespace AppBundle\Interfaces;

use AppBundle\Entity\User;

interface entityAuthorInterface
{
    public function setCreatedBy(User $createdBy);
}