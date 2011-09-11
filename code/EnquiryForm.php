<?php

class EnquiryForm extends Form{

	function __construct($controller,$name,$fields = null,$actions = null,$validator = null){

		if(!$fields)
			$fields = new FieldSet(
				new TextField('Name',_t("EnquiryForm.NAME","Name")),
				new EmailField('Email',_t("EnquiryForm.EMAIL","Email")),
				new TextField('Phone',_t("EnquiryForm.PHONE","Phone")),
				new TextareaField('Message',_t("EnquiryForm.MESSAGE",'Message'))
			);
		if(!$actions)
			$actions = new FieldSet(
				new FormAction("submitenquiry",_t("EnquiryForm.SUBMIT","Send Enquiry"))
			);
		parent::__construct($controller,$name,$fields,$actions,$validator);
	}

	function submitenquiry($data,$form){

		$siteconfig = SiteConfig::current_site_config();
		$to = Email::getAdminEmail();
		$subject = _t("EnquiryForm.SUBJECT","Website Contact");
		//$data = new ArrayData($data);
		$form->makeReadOnly();
		$email = new Email($to,$to,$subject,$this->customise(array('Values' => $form->Fields()))->renderWith('EnquiryEmail'));
		if(isset($data['Email']) && Email::is_valid_address($data['Email']))
			$email->replyTo($data['Email']);
		$success = $email->send();
		$content = ($siteconfig && $siteconfig->EnquiryContent) ? $siteconfig->EnquiryContent : '<p>Thanks for your contact. We\'ll be in touch shortly.</p>' ;

		if(Director::is_ajax()){
			return "success";
		}
		return array(
				'Title' => 'Contact a Technician',
				'Content' => $content
		);
	}

}