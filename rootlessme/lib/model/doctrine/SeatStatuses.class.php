<?php

/**
 * SeatStatuses
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    RootlessMe
 * @subpackage model
 * @author     awilliams
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class SeatStatuses extends BaseSeatStatuses
{
    /**
     * Converts the object to a string. Overrides the default implementation.
     * @return string The seat status as a string
     */
    public function __toString()
    {
        return $this->getDisplayText();
    }
}