<?php

class EnquiryForm extends Form{

	protected $emailtemplate = "EnquiryEmail";
	protected $emailsubject;

	protected $extraemaildata;

	public function __construct($controller, $name, $fields = null, $actions = null, $validator = null){

		if(!$fields)
			$fields = new FieldList(
				new TextField('Name',_t("EnquiryForm.NAME","Name")),
				new EmailField('Email',_t("EnquiryForm.EMAIL","Email")),
				new TextField('Phone',_t("EnquiryForm.PHONE","Phone")),
				new TextareaField('Message',_t("EnquiryForm.MESSAGE",'Message'))
			);
		if(!$actions)
			$actions = new FieldList(
				new FormAction("submitenquiry",_t("EnquiryForm.SUBMIT","Send Enquiry"))
			);
		parent::__construct($controller ,$name, $fields, $actions, $validator);
		
		if(class_exists('SpamProtectorManager')) {
			$this->enableSpamProtection();
		}
	}

	public function submitenquiry($data,$form){

		$siteconfig = SiteConfig::current_site_config();
		$to = Email::getAdminEmail();
		$subject = $this->emailsubject ? $this->emailsubject :
			_t("EnquiryForm.SUBJECT","Website Contact");
		$form->makeReadOnly();

		$data = array(
			'Values' => $form->Fields()
		);
		if($this->extraemaildata){
			$data = array_merge($data, $this->extraemaildata);
		}
		$email = new Email(
			$to, $to, $subject,
			$this->customise($data)->renderWith($this->emailtemplate)
		);
		if(
			isset($data['Email']) && 
			Email::is_valid_address($data['Email'])
		){
			$email->replyTo($data['Email']);
		}
		$success = $email->send();

		$defaultmessage = "<p class=\"message good\">".
			_t("Enquiry.SUCCESS",
				"Thanks for your contact. We'll be in touch shortly."
			).
		"</p>";
		$content = ($siteconfig && $siteconfig->EnquiryContent) ?
						$siteconfig->EnquiryContent : $defaultmessage ;

		if(Director::is_ajax()){
			return "success";
		}

		return new Page_Controller(new Page(array(
			'Title' => _t('Enquiry.Singular','Enquiry'),
			'Content' => $content,
			'EnquiryForm' => ''
		)));
	}

	public function setEmailTemplate($template) {
		$this->emailtemplate = $template;
	}

	public function setEmailSubject($subject) {
		$this->emailsubject = $subject;
	}

	public function setExtraEmailData($data) {
		$this->extraemaildata = $data;
	}

}