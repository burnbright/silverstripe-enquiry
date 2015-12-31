<?php

class DontShowEnquiryForm extends DataExtension
{

    public function contentcontrollerInit()
    {
        $this->owner->DontShowEnquiryForm = true;
    }
}
