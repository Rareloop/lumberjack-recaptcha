<?php

namespace Rareloop\Lumberjack\Recaptcha\Twig;

use Twig\TwigFunction;
use Rareloop\Lumberjack\Config;
use Twig\Extension\AbstractExtension;

class RecaptchaExtension extends AbstractExtension
{
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('recaptcha', [$this, 'recaptcha']),
        ];
    }

    public function recaptcha()
    {
        wp_enqueue_script('lumberjack-recaptcha', 'https://www.google.com/recaptcha/api.js', [], 'v2');

        return '<div class="g-recaptcha" data-sitekey="' . $this->config->get('recaptcha.key') . '"></div>';
    }
}
