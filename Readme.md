# Dev Banner

Add a short description here. You can also add a screenshot if needed.

## Installation

### Manually

* Copy the module into ```<thelia_root>/local/modules/``` directory and be sure that the name of the module is DevBanner.
* Activate it in your thelia administration panel

### Composer

Add it in your main thelia composer.json file

```
composer require thelia/dev-banner-module:~1.0
```

## Usage

Activate the module and add the message you want to display. You can use html. Once you save, your message will be displayed on the top of each page.
## Hook

It uses the ``main.before-content`` hook for display purpose and ``module.configuration`` hook on the module configuration page
