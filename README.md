# Lumberjack ReCAPTCHA

This package provides a simple integration for ReCAPTCHA v2 with Lumberjack and the [`lumberjack-validation`](https://github.com/rareloop/lumberjack-validation) package.

## Installation

`composer require rareloop/lumberjack-recaptcha`

Once installed, register the Service Provider in config/app.php:

```php
'providers' => [
    ...

    Rareloop\Lumberjack\Recaptcha\RecaptchaServiceProvider::class,

    ...
],
```

Copy the example `config/recaptcha.php` file to you theme directory.

Add your ReCAPTCHA credentials to your `.env` file:

```
GOOGLE_RECAPTCHA_KEY="ABC123"
GOOGLE_RECAPTCHA_SECRET="ABC123"
```

## Usage

Make sure you call the `recaptcha()` Twig function in the form that you wish to add support to:

```html
<form method="" action="">
    <input name="my-input-name" type="text">
    {{ recaptcha() }}
    <button type-"submit">Submit</button>
</form>
```

And then add the validation to your Form class to ensure that it is checked:

```php
<?php

namespace App\Http\Forms;

use Rareloop\Lumberjack\Validation\AbstractForm;

class ContactForm extends AbstractForm
{
    /**
     * The validation rules for this form
     *
     * @type {Array}
     */
    protected $rules = [
        'my-input-name' => 'required',
        'g-recaptcha-response' => ['required', 'recaptcha'],
    ];
}

```

## Showing an error

You may also want to show an error if the ReCAPTCHA fails for some reason. Assuming you're passing the standard `errors` array into your view you can simply check for the presence of the `g-recaptcha-response` key:

```html
<form method="" action="">
    <input name="my-input-name" type="text">
    {{ recaptcha() }}
    {% if errors['g-recaptcha-response'] %}
        {% for error in errors['g-recaptcha-response'] %}
            <p class="error">{{ error }}</p>
        {% endfor %}
    {% endif %}
    <button type-"submit">Submit</button>
</form>
```
