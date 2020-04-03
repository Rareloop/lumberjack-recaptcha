<?php

return [
    'key' => getenv('GOOGLE_RECAPTCHA_KEY'),
    'secret' => getenv('GOOGLE_RECAPTCHA_SECRET'),
    'hostname' => getenv('GOOGLE_RECAPTCHA_HOSTNAME') ?: $_SERVER['SERVER_NAME'],
];
