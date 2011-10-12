<?php

class EnquiryFormExtension extends Extension{


	function EnquiryForm(){
		if(!$this->DontShowEnquiryForm)
			return new EnquiryForm($this->owner,"EnquiryForm");
		return null;
	}

}