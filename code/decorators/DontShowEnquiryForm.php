<?php

class DontShowEnquiryForm extends DataObjectDecorator{

	function contentcontrollerInit(){
		$this->owner->DontShowEnquiryForm = true;
	}

}