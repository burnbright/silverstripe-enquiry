# SilverStripe enqiury module

As simple email form that will be sent to the website administrator when submitted.

## Setup

Add the following to your `_config/config.yaml` file:

```yaml
Page_Controller:
  extensions:
    - EnquiryFormExtension
```

You can disable the form from being on sub controllers by extending those with the `DontShowEnquiryForm`:

```yaml
Page:
    extensions:
        - DontShowEnquiryForm
```
