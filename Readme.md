# Dev Banner

Display a short message on the top of the back-office page

## Installation

### Composer

Add it in your main thelia composer.json file

```
composer require thelia/dev-banner-module:~1.0
```

## Usage

Activate the module and add the message you want to display. You can use html. Once you save, your message will be displayed on the top of each page.
## Hook

It uses the ``main.before-content`` hook for display purpose and ``module.configuration`` hook on the module configuration page
