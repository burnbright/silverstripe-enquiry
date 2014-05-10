<?php

class DontShowEnquiryForm extends DataExtension{

	function contentcontrollerInit(){
		$this->owner->DontShowEnquiryForm = true;
	}

}