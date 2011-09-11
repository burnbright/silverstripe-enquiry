<?php

class SiteConfigEnquiryDecorator extends DataObjectDecorator{

	function extraStatics(){
		return array(
			'db' => array(
				'EnquiryContent' => 'HTMLText'
			)
		);
	}

	function updateCMSFields(&$fields){
		$fields->addFieldsToTab("Root.EmailEnquiries", array(
			new HtmlEditorField('EnquiryContent','Content to show after enquiry form has been submitted')
		));
	}

}