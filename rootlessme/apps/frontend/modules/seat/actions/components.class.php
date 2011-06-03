<?php

class seatComponents extends sfComponents
{
    public function executeSeatForm(sfWebRequest $request)
    {
        $this->seatForm = new SeatsForm();
    }
}
