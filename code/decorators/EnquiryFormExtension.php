<?php

class EnquiryFormExtension extends Extension{

	private static $allowed_actions = array(
		'EnquiryForm',
		'submitenquiry'
	);

	function EnquiryForm(){
		if(!$this->owner->DontShowEnquiryForm)
			return new EnquiryForm($this->owner,"EnquiryForm");
		return null;
	}

}