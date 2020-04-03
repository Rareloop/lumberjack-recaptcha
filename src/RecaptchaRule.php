<?php

namespace Rareloop\Lumberjack\Recaptcha;

use ReCaptcha\ReCaptcha;
use Rakit\Validation\Rule;
use Rareloop\Lumberjack\Config;

class RecaptchaRule extends Rule
{
    protected $key = 'recaptcha';
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function check($value)
    {
        $recaptcha = new ReCaptcha($this->config->get('recaptcha.secret'));

        $resp = $recaptcha->setExpectedHostname($this->config->get('recaptcha.hostname'))
            ->verify($value, $_SERVER['REMOTE_ADDR']);

        return $resp->isSuccess();
    }
}
