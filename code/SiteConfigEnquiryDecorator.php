<?php

class SiteConfigEnquiryDecorator extends DataExtension
{

    private static $db = array(
        'EnquiryContent' => 'HTMLText'
    );

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab("Root.EmailEnquiries", array(
            new HtmlEditorField('EnquiryContent', 'Content to show after enquiry form has been submitted')
        ));
    }
}
