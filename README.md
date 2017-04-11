# WP User QR Code Generation

This repo is a snippet of code to add to your Wordpress theme, or to integrate into a Plugin to auto generate a unique 8 digit (customisable) QR Code which is appended to the WP Users Rest API for use in an App etc.

This was specifically written to work with [Angular QR Code](https://github.com/monospaced/angular-qrcode), so provides no support and is just a helpful guide on how to send unique User QR Codes back to any App via WP Users Rest API.

## Requirements

Wordpress 4+

Existing Wordpress Theme / Plugin to integrate into

PHP 5.6+

## Considerations

In this example, the file UserQr.php lives inside /includes/UserQr.php relative to them folder.

You may not need to use the filter for 'rest_prepare_user' if you are using ACF to pull UserMeta into the WP Users Rest API. The key used here follows hidden UserMeta convention with the prepended '_' so remember if you use ACF it may be nested as follows 

```php
user.meta._qr_code
```

In this case you'll have to ensure your ACF field key is '_qr_code' as oppose to 'qr_code'.