<?php

/**
 * People
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class People extends BasePeople
{
    public function __toString()
    {
        $personName = "";
        if ($this->getProfiles()->getFullName() != null)
        {
            $personName = $this->getProfiles()->getFullName();
        }
        return $personName;
    }
}